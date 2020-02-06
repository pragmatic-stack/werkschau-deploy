const fs = require('fs-extra');
const path = require('path');
const kkRandUtils = require('./kkRandUtils');

async function createKirbyTextFile(folder, baseObject, filename){
  let content = '';
  console.log('CALLED CREATE TXT');

  Object.keys(baseObject).forEach(key => {
    switch(baseObject[key].type){
      case 'text':
        content += createTextField(key, baseObject[key].value, true);
        break;
      case 'image':
        content += createFileField(key, baseObject[key].value, true);
        break;
      case 'images':
        content += createImagesField(key, baseObject[key].value, true);
        break;
    }
  });

  fs.writeFileSync(folder + `/${filename}.txt`, content, (err) => {console.log(err)})
}
function createTextField(fieldKey, fieldValue, hasSeperator){
  let value = '';

  fieldKey = fieldKey.toLowerCase();
  fieldKey = fieldKey.charAt(0).toUpperCase() + fieldKey.slice(1);

  value += fieldKey + `: ${fieldValue}`;
  if( hasSeperator) {
    value += fieldSeparator();
  }

  return value;
}
function createFileField(fieldKey, fieldValue, hasSeperator){
  let value = '';

  fieldKey = fieldKey.toLowerCase();
  fieldKey = fieldKey.charAt(0).toUpperCase() + fieldKey.slice(1);

  value += fieldKey + `: \n  - ${fieldValue}`;
  if( hasSeperator) {
    value += fieldSeparator();
  }

  return value;
}
function createImagesField(fieldKey, fieldValues, hasSeparator){
  let value = '';

  fieldKey = fieldKey.toLowerCase();
  fieldKey = fieldKey.charAt(0).toUpperCase() + fieldKey.slice(1);

  value += fieldKey + `: \n`;

  fieldValues.forEach(val => {
    value += `- ${val}\n`;
  });

  if( hasSeparator ) {
    value += fieldSeparator();
  }

  return value;
}
function fieldSeparator() {
  return '\n\n----\n\n';
}
function titleToFolderName(title) {
  title = title.toLowerCase();

  return title.split(' ').join('-');
}
function folderNameToTitle(folderName) {
  const parts = folderName.split('-');
  const transformedParts = parts.map(part => part.charAt(0).toUpperCase() + part.slice(1));

  let title = '';

  transformedParts.forEach(part => { title += part + ' '});

  return title.trimEnd();
}
async function saveFakeImageStream(folderPath, streamResponse) {
  const writer = fs.createWriteStream(folderPath);

  streamResponse.data.pipe(writer);

  return new Promise((resolve, reject) => {
    writer.on('finish', resolve);
    writer.on('error', reject);
  })
}
async function saveFakeImageTxt(folderPath, filename){
  let content = '';

  content += createTextField('caption', filename, true);
  content += createTextField('template', 'image', false);

  fs.writeFileSync(folderPath + '/' + filename + '.txt', content, err => {console.log(err)});
}
function randomImageFromLocalFolder(folderPath){
  const dircontent = fs.readdirSync(folderPath, {withFileTypes: true});
  const dirs = dircontent.filter(entry => entry).map(entry => entry.name);
  const index = kkRandUtils.getRandomIntIncl(0, dirs.length - 1);

  return {name: dirs[index], path: path.join(folderPath, dirs[index])};
}
function saveLocalFakeImage({name, path}, targetPath){
  fs.copySync(path, targetPath + '/' + name);
  saveFakeImageTxt(targetPath, name);
}

exports.createKirbyTextFile         = createKirbyTextFile;
exports.createTextField             = createTextField;
exports.createFileField             = createFileField;
exports.fieldSeparator              = fieldSeparator;
exports.titleToFolderName           = titleToFolderName;
exports.folderNameToTitle           = folderNameToTitle;
exports.saveFakeImageStream         = saveFakeImageStream;
exports.saveFakeImageText           = saveFakeImageTxt;
exports.saveLocalFakeImage          = saveLocalFakeImage;
exports.randomImageFromLocalFolder  = randomImageFromLocalFolder;
