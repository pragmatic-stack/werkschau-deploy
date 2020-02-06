const fs = require('fs');
const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');

function kebabToCamelCase(string) {

    while (string.indexOf('-') !== -1) {
        const minusPos = string.indexOf('-');

        let part = string.slice(minusPos + 1).split('');
        part[0] = part[0].toUpperCase();
        string = string.slice(0, minusPos) + part.join('');
    }

    return string;
}

exports.kebabToCamelCase = kebabToCamelCase;

function camelToKebabCase(string) {
    string = string.split('');

    for (let i = 0; i < string.length; i++) {
        if (string[i] === string[i].toUpperCase()) {
            string[i] = string[i].toLowerCase();
            string.splice(i, 0, '-');
            i++;
        }
    }

    return string.join('');
}

exports.camelToKebabCase = camelToKebabCase;

exports.readPages = (path) => {
    return new Promise((resolve, reject) => {
        fs.readdir(path, function (err, items) {
            if (err) {
                reject(err)
            }
            resolve(items);
        });
    })
};

exports.buildEntries = (pages) => {
    return new Promise((resolve, reject) => {
        let entries = {};

        console.log('Built entries and converted filenames for Kirby.');

        pages.forEach(page => {
            page = page.replace('-', '');

            console.log(page, ' -> ', camelToKebabCase(page));

            entries[page] = path.resolve(__dirname, '..', `src/pages/${page}/${page}.js`);
        });

        resolve(entries);
    })
};

exports.buildHtmlWebpackPlugins = (pages) => {
    return new Promise((resolve) => {
        let plugins = [];

        pages.forEach(page => {
            if (page !== 'index') {

                plugins.push(new HtmlWebpackPlugin(
                    {
                        template: path.resolve(__dirname, '..', `src/pages/${page}/${page}.html`),
                        inject: true,
                        chunks: ['index', page],
                        filename: `${camelToKebabCase(page)}.html`,
                        title: `Template für ${page}`
                    })
                )
            }
        });


        resolve(plugins);
    })
};
