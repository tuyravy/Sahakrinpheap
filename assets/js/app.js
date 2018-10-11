
var base_url = window.location.origin;
if('serviceWorker' in navigator){  
    window.addEventListener('load',()=>{
        navigator.serviceWorker
        .register(base_url+'skp_reports/assets/js/service-worker.js')
        .then(reg=>console.log(`Service Worker: Registered`))
        .catch(err=>console.log(`Service Worker: Error:${err}`));
    })
   
}