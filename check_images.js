const fs = require('fs');
const path = require('path');
const https = require('https');

const dirs = [
    'frontend/src/pages',
    'backend/database/seeders'
];

const workspace = 'c:/Users/user/Desktop/Marea';
const urls = new Set();
const fileMapping = {};

function scanDir(dir) {
    const files = fs.readdirSync(dir);
    for (const file of files) {
        const fullPath = path.join(dir, file);
        const stat = fs.statSync(fullPath);
        if (stat.isDirectory()) {
            scanDir(fullPath);
        } else if (fullPath.endsWith('.jsx') || fullPath.endsWith('.php')) {
            const content = fs.readFileSync(fullPath, 'utf8');
            const matches = content.match(/https:\/\/images\.unsplash\.com\/photo-[a-zA-Z0-9-]+/g);
            if (matches) {
                for (const match of matches) {
                    urls.add(match);
                    if (!fileMapping[match]) fileMapping[match] = [];
                    fileMapping[match].push(fullPath.replace(workspace + '\\', ''));
                }
            }
        }
    }
}

for (const d of dirs) {
    scanDir(path.join(workspace, d));
}

const urlList = Array.from(urls);
console.log(`Found ${urlList.length} unique Unsplash URLs.`);

async function fetchTitle(url) {
    const id = url.split('photo-')[1].split('?')[0];
    const pageUrl = `https://unsplash.com/photos/${id}`;
    
    return new Promise((resolve) => {
        https.get(pageUrl, {
            headers: {
                'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
            }
        }, (res) => {
            let data = '';
            res.on('data', chunk => data += chunk);
            res.on('end', () => {
                const altMatch = data.match(/<img[^>]+alt="([^"]+)"[^>]+src="[^"]+photo-${id}/i);
                const titleMatch = data.match(/<title>(.*?)<\/title>/);
                let desc = altMatch ? altMatch[1] : (titleMatch ? titleMatch[1] : 'Unknown');
                resolve({ url, desc });
            });
        }).on('error', () => {
            resolve({ url, desc: 'Error fetching' });
        });
    });
}

async function run() {
    const results = [];
    const batchSize = 10;
    
    for (let i = 0; i < urlList.length; i += batchSize) {
        const batch = urlList.slice(i, i + batchSize);
        console.log(`Processing batch ${i / batchSize + 1} of ${Math.ceil(urlList.length / batchSize)}`);
        const batchResults = await Promise.all(batch.map(fetchTitle));
        results.push(...batchResults);
    }
    
    const finalReport = results.map(r => ({
        url: r.url,
        description: r.desc,
        files: fileMapping[r.url]
    }));
    
    fs.writeFileSync(path.join(workspace, 'image_report.json'), JSON.stringify(finalReport, null, 2));
    console.log('Done! Wrote to image_report.json');
}

run();
