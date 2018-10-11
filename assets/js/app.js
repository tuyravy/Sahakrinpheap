
var base_url = window.location.origin;
if('serviceWorker' in navigator){  
    window.addEventListener('load',()=>{
        navigator.serviceWorker
<<<<<<< .merge_file_a13588
        .register(base_url+'skp_reports/assets/js/service-worker.js')
=======
        .register(base_url+'/skp_reports/assets/js/service-worker.js')
>>>>>>> .merge_file_a06972
        .then(reg=>console.log(`Service Worker: Registered`))
        .catch(err=>console.log(`Service Worker: Error:${err}`));
    })
   
}