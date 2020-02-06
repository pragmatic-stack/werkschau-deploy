const path = require('path');
const fs = require('fs');
let pageName = process.argv[2];
const baseFolder = path.resolve(__dirname, '..', 'src/pages');
const util = require('./webpack-config.utilities');

const createFiles = (dir, pageName) => {

    fs.writeFileSync(path.resolve(dir, pageName + '.js'), `import \'./${pageName}.scss\';`);
    fs.writeFileSync(path.resolve(dir, pageName + '.scss'), ``);

    fs.readFile(path.resolve(__dirname, '..', 'src/snippets/baseTemplate/baseTemplate.html'), 'utf-8', function (err, data) {
        if (err) throw err;

        const newValue = data.replace('{{ pageName }}', pageName);

        fs.writeFile(path.resolve(dir, pageName + '.html'), newValue, 'utf-8', function (err) {
            if (err) throw err;
            console.log('filelistAsync complete');
        });
    });
};

if (pageName) {
    pageName = util.kebabToCamelCase(pageName);

    const dir = path.resolve(baseFolder, pageName);

    if (!fs.existsSync(dir)) {
        fs.mkdirSync(path.resolve(baseFolder, pageName));

        createFiles(dir, pageName);
    } else {
        console.log('WARNING: folder', pageName, 'already exists');
    }

} else {
    console.log('nothing added - no page name');
}



