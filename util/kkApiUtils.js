const Axios = require('axios');
const Download = require('image-downloader');

function getImageDataStream(url, method){
  return Axios({
    url,
    method,
    responseType: 'stream'
  }).catch(err => {console.log(err)});
}

function getLandscapePlaceholderStream(){
  return Axios({
    url: 'https://placehold.it/800x600',
    method: 'get',
    responseType: 'stream'
  }).catch(err => {console.log(err)});
}

function getResponseFrom(url, method){
  return Axios({
    url,
    method
  }).catch(err => {console.log(err)});
}

exports.getImageDataStream = getImageDataStream;
exports.getResponseFrom = getResponseFrom;
exports.getLandscapePlaceholderStream = getLandscapePlaceholderStream;
