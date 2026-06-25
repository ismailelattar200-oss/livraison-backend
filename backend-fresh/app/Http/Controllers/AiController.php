<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
use App\Models\MenuItem;

class AiController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'history' => 'nullable|array',
        ]);

        $userMessage = $request->input('message');
        $rawHistory = $request->input('history', []);
        
        $apiKey = env('ANTHROPIC_API_KEY');
        
        // Mode Démo (Mock) : Si pas de clé API valide (permet de tester immédiatement sans clé)
        if (!$apiKey || $apiKey === 'your_key_here' || str_contains($apiKey, 'xxxx')) {
            $msgLower = strtolower($userMessage);
            
            if (str_contains($msgLower, 'confirmer') || (str_contains($msgLower, 'oui') && str_contains($msgLower, 'commande'))) {
                $reply = "Parfait ! J'ai bien noté votre commande de 2 Tajine d'Agneau et 1 Jus d'Orange pour un total de 610 MAD. Veuillez remplir les informations ci-dessous pour finaliser votre commande :\n\n[ACTION:SHOW_FORM:{\"items\":[{\"id\":1,\"name\":\"Tajine d'Agneau\",\"quantity\":2,\"price\":280},{\"id\":5,\"name\":\"Jus d'Orange Frais\",\"quantity\":1,\"price\":50}],\"type\":\"livraison\",\"subtotal\":610,\"total\":610}]";
            } elseif (str_contains($msgLower, 'commander') || str_contains($msgLower, 'commande')) {
                $reply = "Avec grand plaisir ! Que souhaitez-vous commander aujourd'hui ? Voici quelques suggestions de notre carte marocaine :\n- Tajine d'Agneau aux Pruneaux (280 MAD)\n- Couscous Royal MAREA (320 MAD)\n- Pastilla au Poulet et Amandes (250 MAD)\n\nIndiquez-moi les plats et quantités désirés !";
            } elseif (str_contains($msgLower, 'dimanche') || str_contains($msgLower, 'horaire') || str_contains($msgLower, 'ouvert')) {
                $reply = "Oui, absolument ! Nous sommes ouverts le dimanche de 13:00 à 17:00. Du lundi au jeudi nous vous accueillons de 13:00 à 23:30, et le vendredi et samedi jusqu'à 01:00 du matin.";
            } elseif (str_contains($msgLower, 'menu') || str_contains($msgLower, 'carte') || str_contains($msgLower, 'plat')) {
                $reply = "Voici nos principales catégories au menu :\n1. **Cocina Marroquí** (Tajines, Couscous, Pastilla...)\n2. **Entrées Méditerranéennes** (Carpaccio, Burrata...)\n3. **Poissons & Fruits de Mer**\n4. **Desserts & Boissons**\n\nQue souhaitez-vous découvrir plus en détail ?";
            } elseif (str_contains($msgLower, 'tajine')) {
                $reply = "Le **Tajine d'Agneau** (280 MAD) est une spécialité incontournable de notre chef : des morceaux d'agneau tendres mijotés lentement avec des pruneaux caramélisés, des amandes grillées et des épices douces marocaines. Un véritable délice !";
            } else {
                $reply = "Bonjour et bienvenue chez MAREA ! Je suis votre assistant virtuel. Je peux vous renseigner sur nos horaires, notre carte méditerranéenne et marocaine, ou vous guider pas à pas pour passer commande. Comment puis-je vous aider ?";
            }

            usleep(1000000); // 1s simulation

            return response()->json([
                'success' => true,
                'reply' => $reply
            ]);
        }

        // Mode Réel : Construction du prompt système avec base de données
        try {
            $categories = Category::with(['menuItems' => function($q) {
                $q->where('is_available', true)->orderBy('display_number');
            }])->orderBy('display_order')->get();

            $menuText = "";
            foreach ($categories as $cat) {
                $menuText .= "Catégorie : {$cat->name}\n";
                foreach ($cat->menuItems as $item) {
                    $menuText .= "- ID: {$item->id} | {$item->name} ({$item->price} MAD) : {$item->description}\n";
                }
                $menuText .= "\n";
            }

            $restaurantInfo = "Nom : MAREA Restaurant\n" .
                "Adresse : 15 Rue Principale, 75001 Paris, France\n" .
                "Téléphone : +33 1 23 45 67 89\n" .
                "Horaires : Lundi-Jeudi (13:00-23:30), Vendredi-Samedi (13:00-01:00), Dimanche (13:00-17:00)\n" .
                "Histoire & Concept : Saveurs authentiques de la Méditerranée et du Maroc dans un cadre élégant et chaleureux.\n" .
                "Allergènes : Informations disponibles sur demande pour chaque plat (poissons, fruits à coque, gluten, produits laitiers).\n" .
                "Moyens de paiement acceptés : Carte bancaire, PayPal, Espèces.\n" .
                "Zones et frais de livraison : Livraison Premium gratuite pour toute commande supérieure à 500 MAD, sinon frais standard.";

            $systemPrompt = "Tu es l'assistant virtuel de MAREA, un restaurant méditerranéen et marocain. Tu réponds en français de manière chaleureuse et professionnelle. Tu peux:\n" .
                "1. Répondre aux questions sur le restaurant\n" .
                "2. Présenter le menu et décrire les plats\n" .
                "3. Aider le client à passer une commande complète\n" .
                "Quand le client veut commander, guide-le étape par étape, confirme sa sélection et demande ses informations (nom, email, adresse, téléphone) pour finaliser la commande.\n\n" .
                "INSTRUCTIONS SPÉCIALES POUR LA COMMANDE :\n" .
                "- Demande au client s'il souhaite une livraison ou à emporter.\n" .
                "- Calcule avec précision le sous-total et le total selon les prix indiqués dans le menu.\n" .
                "- Lorsque le client confirme définitivement le résumé de sa commande (ex: 'Oui confirmer' ou 'C'est bon pour moi'), confirme avec enthousiasme ET ajoute OBLIGATOIREMENT à la toute fin de ton message la balise exacte (sans markdown autour) :\n" .
                "[ACTION:SHOW_FORM:{\"items\":[{\"id\":<id_du_plat>,\"name\":\"<nom>\",\"quantity\":<qte>,\"price\":<prix_unitaire>}],\"type\":\"<livraison|a_emporter>\",\"subtotal\":<st>,\"total\":<tot>}]\n" .
                "Exemple : [ACTION:SHOW_FORM:{\"items\":[{\"id\":1,\"name\":\"Tajine d'Agneau\",\"quantity\":2,\"price\":280}],\"type\":\"livraison\",\"subtotal\":560,\"total\":560}]\n\n" .
                "Voici le menu complet:\n" . $menuText . "\n" .
                "Infos restaurant:\n" . $restaurantInfo;

            // Préparation des messages pour l'API Anthropic (alternance user / assistant, max 10 messages)
            $formattedMessages = [];
            foreach (array_slice($rawHistory, -10) as $msg) {
                if (isset($msg['role'], $msg['content']) && in_array($msg['role'], ['user', 'assistant'])) {
                    // Nettoyer d'éventuels tags SHOW_FORM dans l'historique assistant
                    $content = preg_replace('/\[ACTION:SHOW_FORM:.*?\]/', '', $msg['content']);
                    if (trim($content) !== '') {
                        $formattedMessages[] = [
                            'role' => $msg['role'],
                            'content' => trim($content)
                        ];
                    }
                }
            }

            // S'assurer que le premier message est de rôle 'user'
            while (!empty($formattedMessages) && $formattedMessages[0]['role'] === 'assistant') {
                array_shift($formattedMessages);
            }

            // Ajouter le message actuel s'il n'est pas déjà le dernier
            $lastMsg = end($formattedMessages);
            if (!$lastMsg || $lastMsg['role'] !== 'user' || $lastMsg['content'] !== $userMessage) {
                // Si le dernier était 'user', on le remplace
                if ($lastMsg && $lastMsg['role'] === 'user') {
                    array_pop($formattedMessages);
                }
                $formattedMessages[] = [
                    'role' => 'user',
                    'content' => $userMessage
                ];
            }

            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
                'anthropic-version' => '2023-06-01',
                'content-type' => 'application/json',
            ])->post('https://api.anthropic.com/v1/messages', [
                'model' => 'claude-sonnet-4-6',
                'max_tokens' => 1024,
                'system' => $systemPrompt,
                'messages' => $formattedMessages,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $reply = $response->json('content.0.text');
                return response()->json([
                    'success' => true,
                    'reply' => $reply
                ]);
            }

            Log::error('Anthropic API Error: ' . $response->body());

            return response()->json([
                'success' => false,
                'reply' => "Désolé, une erreur est survenue lors de la communication avec l'assistant intelligence artificielle."
            ], 500);

        } catch (\Exception $e) {
            Log::error('AI Exception: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'reply' => "Une erreur technique est survenue. Veuillez réessayer plus tard."
            ], 500);
        }
    }
}
