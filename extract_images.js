const fs = require('fs');
const path = require('path');

const workspace = 'c:/Users/user/Desktop/Marea';

const extractFromHome = () => {
    const content = fs.readFileSync(path.join(workspace, 'frontend/src/pages/public/Home.jsx'), 'utf8');
    let results = [];
    results.push({ file: 'Home.jsx', subject: 'Hero Background (Restaurant MAREA)', url: content.match(/src="(https:\/\/images\.unsplash\.com\/photo-[^"]+)"/)[1] });
    results.push({ file: 'Home.jsx', subject: 'About Teaser (Chef Hassan)', url: content.match(/src="(https:\/\/images\.unsplash\.com\/photo-[^"]+)"[^>]*alt="Chef Hassan"/)[1] });
    return results;
};

const extractFromNosotros = () => {
    const content = fs.readFileSync(path.join(workspace, 'frontend/src/pages/public/Nosotros.jsx'), 'utf8');
    let results = [];
    results.push({ file: 'Nosotros.jsx', subject: 'Restaurant Interior', url: content.match(/src="(https:\/\/images\.unsplash\.com\/photo-[^"]+)"[^>]*alt="Intérieur du restaurant"/)[1] });
    results.push({ file: 'Nosotros.jsx', subject: 'Chef Hassan', url: content.match(/src="(https:\/\/images\.unsplash\.com\/photo-[^"]+)"[^>]*alt="Chef Hassan"/)[1] });
    return results;
};

const extractFromLogin = () => {
    const content = fs.readFileSync(path.join(workspace, 'frontend/src/pages/public/Login.jsx'), 'utf8');
    let results = [];
    results.push({ file: 'Login.jsx', subject: 'Login Background', url: content.match(/src="(https:\/\/images\.unsplash\.com\/photo-[^"]+)"/)[1] });
    return results;
};

const extractFromContacto = () => {
    const content = fs.readFileSync(path.join(workspace, 'frontend/src/pages/public/Contacto.jsx'), 'utf8');
    let results = [];
    results.push({ file: 'Contacto.jsx', subject: 'Contact Map/Location', url: content.match(/src="(https:\/\/images\.unsplash\.com\/photo-[^"]+)"[^>]*alt="Carte"/)[1] });
    return results;
};

const extractFromMenuItemSeeder = () => {
    const content = fs.readFileSync(path.join(workspace, 'backend/database/seeders/MenuItemSeeder.php'), 'utf8');
    let results = [];
    const regex = /'name'\s*=>\s*'([^']+)'[\s\S]*?'image_url'\s*=>\s*'([^']+)'/g;
    let match;
    while ((match = regex.exec(content)) !== null) {
        if (match[2].includes('images.unsplash.com')) {
            results.push({ file: 'MenuItemSeeder.php', subject: 'Dish: ' + match[1], url: match[2] });
        }
    }
    return results;
};

const extractFromGallerySeeder = () => {
    const content = fs.readFileSync(path.join(workspace, 'backend/database/seeders/GallerySeeder.php'), 'utf8');
    let results = [];
    const regex = /'image_url'\s*=>\s*'([^']+)'[\s\S]*?'caption'\s*=>\s*'([^']+)'/g;
    let match;
    while ((match = regex.exec(content)) !== null) {
        results.push({ file: 'GallerySeeder.php', subject: 'Gallery: ' + match[2], url: match[1] });
    }
    return results;
};

const extractFromEventSeeder = () => {
    const content = fs.readFileSync(path.join(workspace, 'backend/database/seeders/EventSeeder.php'), 'utf8');
    let results = [];
    const regex = /'title'\s*=>\s*'([^']+)'[\s\S]*?'image_url'\s*=>\s*'([^']+)'/g;
    let match;
    while ((match = regex.exec(content)) !== null) {
        results.push({ file: 'EventSeeder.php', subject: 'Event: ' + match[1], url: match[2] });
    }
    return results;
};

let allImages = [];
allImages = allImages.concat(extractFromHome());
allImages = allImages.concat(extractFromNosotros());
allImages = allImages.concat(extractFromLogin());
allImages = allImages.concat(extractFromContacto());
allImages = allImages.concat(extractFromMenuItemSeeder());
allImages = allImages.concat(extractFromGallerySeeder());
allImages = allImages.concat(extractFromEventSeeder());

let markdown = `## Full Image Review List\n\n`;
markdown += `| File | Intended Subject | Current URL |\n`;
markdown += `|------|------------------|-------------|\n`;

allImages.forEach(img => {
    markdown += `| ${img.file} | ${img.subject} | ${img.url} |\n`;
});

fs.writeFileSync(path.join(workspace, 'image_list.md'), markdown);
console.log('Markdown list generated successfully at image_list.md');
