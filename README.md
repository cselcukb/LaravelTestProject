Proje github dan indirildikten sonra, Linux üzerinde sh docker/setup.sh dosyası çalıştırılarak proje, 127.0.0.1:8000 üzerine kurulmuş olacaktır.Projede URL ler:
GET -> http://127.0.0.1:8000/api/markers  ve http://127.0.0.1:8000/api/markers/{marker_id} -> hepsini getirme ve tek marker getirme için

POST ->http://127.0.0.1:8000/api/markers ve http://127.0.0.1:8000/api/markers/{marker_id} -> marker ekleme ve güncelleme için

İlk markerı baz konum alarak en kısa mesafeye göre markerları konumlayan URL ->http://127.0.0.1:8000/api/markers/calculateRoute
Bu URL e örnek olarak markers parametre adı altında şu değeri göndererek test edebilirsiniz: 41.02572934629449, 28.974438863081275;41.005539632352374, 28.976740761065997;41.03345092597432, 28.98348273638836;41.0267251327222,28.980286587668328;41.04349638842987, 28.990389047663882;41.00843802767273, 28.971035021951337;41.02198291581627,28.976296422585385;41.04133709671935, 29.00667655163188;41.008689057643686, 28.980195995586328

Projede iki class ekledim ve bu classlar için test dosyaları ekledim. Proje dizininde vendor/bin/phpunit dosyasını çalıştırarak testleri çalıştırabilirsiniz.
