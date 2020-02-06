'use strict';
// requirements and dependencies
const faker = require('faker');
const fs    = require('fs');
const path  = require('path');

// self written dependencies
const kkFileUtils = require('./kkFileUtils');
const kkApiUtils  = require('./kkApiUtils');
const kkRandUtils = require('./kkRandUtils');

// constant definitions
const studiengaenge = [
  'Kommunikationsdesign KD - BA',
  'Interaktive Medien IA - BA',
  'Interaktive Medien IA - BSC',
  'Interaktive Mediensystems IMS - MA',
  'Design- und Kommunikationsstrategie DKS - MA'
];

const allowedTags   = ['#3D', '#advertising', '#animation', '#app', '#AR/VR', '#bookdesign', '#branding',
  '#conding', '#editorial', '#film', '#game', '#illustration', '#informationdesign',
  '#interactive', '#motion', '#typedesign', '#UI/UX', '#web', '#development', '#photography'];

const dozenten      = ['Prof. Kai Bergmann', 'Prof. Daniel Rothaug'];
const buildings     = ['blocks/wirtschaftsgebaude', 'blocks/mensa'];
const roomNumbers   = [101, 102, 103, 104, 105, 106, 107, 202, 203, 204, 205, 206, 207];

// api urls
// needs to return an image data stream as response
const fakeProfileImageApiUrl = 'https://placeimg.com/960/540/people';

// local sample files
const fileWorksFolderDataPath   = path.join(__dirname, 'data', 'img', 'works');
const filePeopleFolderDataPath  = path.join(__dirname, 'data', 'img', 'people');

// base functions
async function createFakeStudent() {

  const vorname   = faker.name.firstName();
  const nachname  = faker.name.lastName();

  // create an unique image name
  const imageName = vorname.toLowerCase() + nachname.toLowerCase() + new Date().getTime();
  // create the folder path for the generated student
  const targetFolder = path.join(__dirname + '/../content/students/' + `${vorname.toLowerCase()}-${nachname.toLowerCase()}`);

  // create the fake student object
  const student = {};
  student.title = {value: vorname + ' ' + nachname, type: 'text'};
  student.vorname = {value: vorname, type: 'text'};
  student.nachname = {value: nachname, type: 'text'};
  student.studiengang = {value: studiengaenge[0], type: 'text'};
  student.email = {value: vorname.toLowerCase() + '@' + nachname.toLowerCase() + '.' + faker.internet.domainSuffix(), type: 'text'};
  student.website = { value: faker.internet.protocol() + '://' + vorname.toLowerCase() + '-' + nachname.toLowerCase() + '.' + faker.internet.domainSuffix(), type: 'text'};
  student.instagram = { value: 'https://instagram.com/' + vorname.toLowerCase() + '-' + nachname.toLowerCase(), type: 'text'};
  student.behance = { value: 'https://behance.net/' + vorname.toLowerCase() + '-' + nachname.toLowerCase(), type: 'text'};

  // create student directory
  fs.mkdirSync(targetFolder, (err) => {console.log(err)});

  // get student profile image url from fake image api
  let profileImage  = kkFileUtils.randomImageFromLocalFolder(filePeopleFolderDataPath);
  let thesisImage   = kkFileUtils.randomImageFromLocalFolder(fileWorksFolderDataPath);
  let comfortImage   = kkFileUtils.randomImageFromLocalFolder(filePeopleFolderDataPath);
  let abschlussarbeit   = kkFileUtils.randomImageFromLocalFolder(filePeopleFolderDataPath);

  kkFileUtils.saveLocalFakeImage(profileImage, targetFolder);
  kkFileUtils.saveLocalFakeImage(thesisImage, targetFolder);
  kkFileUtils.saveLocalFakeImage(comfortImage, targetFolder);
  kkFileUtils.saveLocalFakeImage(abschlussarbeit, targetFolder);

  student.profileImage = {value: profileImage.name, type: 'image'};
  student.abschlussarbeit = {value: thesisImage.name, type: 'image'};
  student.shootingbild = {value: abschlussarbeit.name, type: 'image'};
  student.comfortzone = {value: comfortImage.name, type: 'image'};

  await kkFileUtils.createKirbyTextFile(targetFolder, student, 'student');
  // return important objects for further usage
  return {student, imageName, folderPath: targetFolder};
}
async function createFakeThesis(student){
  const thesis = {};

  thesis.title        = { value: faker.lorem.words(), type: 'text' };
  thesis.student      = { value: student.title.value, type: 'text' };
  thesis.studiengang  = { value: student.studiengang.value, type: 'text' };
  thesis.dozent       = { value: dozenten[0], type: 'text' };
  thesis.building     = { value: buildings[0], type: 'text' };
  thesis.room         = { value: roomNumbers[0], type: 'text'};
  thesis.tags         = { value: getRandomTags(3), type: 'text'};
  thesis.vimeoLink    = { value: 'https://vimeo.com/226746921', type: 'text'};
  thesis.headline     = { value: faker.lorem.sentence(), type: 'text' };
  thesis.subheadline  = { value: faker.lorem.sentence(), type: 'text' };
  thesis.beschreibung = { value: faker.lorem.paragraph(), type: 'text' };

  const studentFolder = path.join(__dirname + '/../content/students/' + `${student.vorname.value.toLowerCase()}-${student.nachname.value.toLowerCase()}`);
  const thesisFolder  = path.join(studentFolder, kkFileUtils.titleToFolderName(thesis.title.value));

  if(fs.existsSync(studentFolder, (err) => { console.log(err) })) {
    fs.mkdirSync(thesisFolder);
  } else {
    return;
  }

  const presentationImageNames = [];

  for(let i = 0; i < 3; i++){
    let localImage = kkFileUtils.randomImageFromLocalFolder(fileWorksFolderDataPath);

    presentationImageNames.push(localImage.name);
    kkFileUtils.saveLocalFakeImage(localImage, thesisFolder);
  }

  thesis.presentation = { value: presentationImageNames, type: 'images'};

  await kkFileUtils.createKirbyTextFile(thesisFolder, thesis, 'abschlussarbeit');
}
async function createStudentWork(student){
  const work = {};

  work.student = student.student.title;
  work.headline = {value: faker.lorem.words(), type: 'text'};
  work.title = work.headline;
  work.beschreibung = {value: faker.lorem.paragraph(), type: 'text'};

  const workImage = kkFileUtils.randomImageFromLocalFolder(fileWorksFolderDataPath);
  work.image = {value: workImage.name, type: 'image'};

  const workPath = path.join(student.folderPath, kkFileUtils.titleToFolderName(work.title.value));

  fs.mkdirSync(workPath, (err) => {console.log(err)});

  await kkFileUtils.createKirbyTextFile(workPath, work, 'semesterarbeit');

  kkFileUtils.saveLocalFakeImage(workImage, workPath);
  return work;
}
async function run(){

  // const resp = await kkApiUtils.getLandscapePlaceholderStream();
  // await saveFakeImage(__dirname + '/test.png', resp);
  // createFakeStudent();
  for(let i = 0; i < 20; i++){
    const student = await createFakeStudent();
    createFakeThesis(student.student);
    const workAmount = kkRandUtils.getRandomIntIncl(1,3);

    for(let i = 0; i < workAmount; i++){
      // create semesterwork
      createStudentWork(student);
    }
  }
}

function getRandomTags(amount){
  let tags = '';

  for(let i = 0; i < amount; i++){
    tags += allowedTags[kkRandUtils.getRandomIntIncl(0, allowedTags.length-1)];

    if(i+1 < amount) {
      tags += ',';
    }
  }

  return tags;
}

run();
