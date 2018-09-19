const CasheName='v1';
const CasheAssets=
[
    '/',
    '/public/font-awesome.min.css',  
    'http://localhost:81/skp_reports/public/font-awesome.min.css',   
    'http://localhost:81/skp_reports/public/bootstrap.min.js',
    '/public/custom.min.js',
    '/public/custom_page.css',
    '/system/',
    'http://localhost:81/index.php/daily/loanPortfolio',
    'http://localhost:81/skp_reports/index.php/daily/activeBorrower',
    'http://localhost:81/skp_reports/index.php/daily/loanPortfolio',
    'http://localhost:81/skp_reports/index.php/daily/repaymentinmonth',
    'http://localhost:81/skp_reports/index.php/daily/loanDisbInMonth',
    'http://localhost:81/skp_reports/index.php/daily/loanDisbDaily',
    'http://localhost:81/skp_reports/index.php/daily/brancPer',
    'http://localhost:81/skp_reports/index.php/dailydceo/dcmrsahakrinpheaceo',    
    'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css',
    'https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css',
    'https://code.jquery.com/ui/1.10.4/jquery-ui.js',
    'https://code.jquery.com/ui/1.10.4/themes/ui-lightness/images/ui-bg_glass_100_fdf5ce_1x400.png',
    'https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js',    
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css',
    'https://cdn.jsdelivr.net/jquery/1/jquery.min.js',
    'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js'
    
];
self.addEventListener("install",function(e){
    console.log("[ServiceWorker] Installed");
    e.waitUntil(
        caches
            .open(CasheName)
            .then(cache=>
                {
                    console.log('Service Worker: Cashing File');
                    cache.addAll(CasheAssets);
                })
            .then(()=>self.skipWaiting())
    );
})
self.addEventListener("activate",function(e){
    console.log("[ServiceWorker] Activated")
})
self.addEventListener('fetch', function(event) {
    console.log(event.request.url);
    event.respondWith(

        caches.match(event.request).then(function(response) {
        
        return response || fetch(event.request);
        
        })
        
        );
});