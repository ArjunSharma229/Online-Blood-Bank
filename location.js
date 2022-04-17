navigator.geolocation
navigator.geolocation.getCurrentPosition(console.log, console.log)

const successfullLookup = (position) => {

  const{ latitude, longitude} = position.coords;
  fetch(`https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=8237a62ab4a9453fa46cfe689b4e9e89`)
  //fetch(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${latitude}&longitude=${longitude}&localityLanguage=en`)
  
  .then(response => response.json())
  .then(data => {
  const suburb= data.results[0].components.suburb;
  console.log("You are from " + suburb)
  showResult.textContent = data.results[0].components.suburb;
  console.log(data);
  })
};
 


navigator.geolocation.getCurrentPosition(successfullLookup,console.log);


