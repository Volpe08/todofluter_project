let {OpenWeatherMap} = require('./openWeather-module-00.js');

let ow = new OpenWeatherMap('API KEY', 'metric');


ow.getWeather('Orleans');