# Projede istenenler

Proje Başarısı için Asgari Koşullar:
- Bootstrap ve responsive uyumlu olmalıdır (desktop,tablet & mobil’de çalışabilmelidir.)
- Projenizde sadece bir yönetim arayüzü (Admin Panel) kullanmalısınız. Bootstrap uyumlu olan AdminLTE şablonlarını kullanmanızı tavsiye ederim (Ayrıca genel bir ön sayfa istenmiyor)
- Projenizi Bootstrap, Php Framework (Codeigniter, Laravel gibi…) ve MySql veritabanı kullanarak geliştirmelisiniz.
- Yönetim paneliniz açılır menu ve slider içermelidir.
- Yönetim panelinize girişte en az e-mail ve şifre ile girilebilecek bir login sayfası yer almalıdır.Bu login sayfası için veri tabanında en az iki rol tanımlanmalı. (Yöneticiler, Standart Kullanıcılar için)
- Her rol için kullanıcılar, kullanıcı adı (e-mail) ve Secure Hashing Algoritması (SHA) ile kriptolanmış şifre ile kaydedilmelidir.
- Her rol için ayrı masterpage/arayüz tanımlanmalıdır. (yönetici veri girişi sayfaları, standart kullanıcı için duyuru ve listeleme sayfaları ve yöneticiye mesaj yollama sayfaları)
- Oluşturulan tüm listeleme ekranlarında gridler üzerinde arama yapılabilmelidir.

Yönetici Sayfaları :
1. Yönetici kullanıcı tanımlama, silme ve güncelleme de yetkilidir.
2. Yönetici sizin belirleyeceğiniz bir kaydetme sayfası için yetkilidir (stok için ürün kaydı, hastane için doktor kaydı, kütüphane için kitap kaydı, okul için öğrenci ya da öğrenme kaydı gibi.).
3. Yönetici standart kullanıcıların anasayfasında gösterilmek üzere duyuru kaydetmeden, güncellemeden ve silmeden yetkilidir. (Standard kullanıcı sisteme girdiğinde duyuruları liste ya da grid üzerinde görebilmeli.)
4. Yönetici standart kullanıcılardan gelen mesajları okuyabilmeli ve cevap yazabilmelidir. Sadece okuduysa mesaj okundu checkbox işaretlenmelidir. Tüm kullanıcıların mesajları zamanıyla birlikte kimden geldiyse, mesajın yanında gösterilmelidir.

Standart Kullanıcı Rolü için:
1. Standart kullanıcı yeni kullanıcı oluşturma yetkisi yoktur. Ancak kendi şifresini güncelleyebilir. O yüzden yönetici sayfalarına erişim yetkisi yoktur (burada session kullanınız)
2. Admin tarafından girilen verilerin (örneğin ürün kayıtlarını listeleme yada arama gibi) listesini ve aramasını yapabilir.
3. Standart Kullanıcı sadece yönetici tarafından girilen duyuruları anasayfasından takip edebilir. 
4. Standart kullanıcı admine mesaj yollayabilir. Bu sebeple, standart kullanıcı için bir mesaj kaydetme ve yöneticiye gönderme sayfası olmalıdır. Yöneticinin mesajı sadece aldığı, okuduğu ve cevap yazdığı şeklindeki durumları da mesaj sayfasından takip edebilmelidir.

## Özet
PHP Framework (Codeigniter, Laravel gibi) kullanarak bootstrap ve responsive uyumlu bir yönetim sayfası üzerinde, 
Admin için:
- Login girişi, 
- Kullanıcı kayıt/güncelleme/silme ekranı.
- Ve ayrı bir kayıt/güncelleme/silme ekranı (ürün, hasta, doktor, öğrenci, kitap gibi..)
- Duyuru kaydetme sayfası
- Standart kullanıcılardan gelen mesajlara okuma ve cevap verme sayfası.

Standart Kullanıcı için:
- Login girişi, 
- Sadece kendi şifresini güncelleme sayfası
- Yöneticinin girdiği verileri görebilir ve veriler üzerinde arama yapabilir.
- Yönetici duyurularını ana sayfadan takip etme
- Yöneticiye mesaj yollar.

Yukarıdaki projeyi php code ignite, mysql ve adminlte templatelerini kullanarak tamamladık.

## Başlatmak için
Önce migrationları yapıyoruz.
php spark migrate

sonrasında da serve edebiliriz.
php spark serve

## Gereksinimler

PHP 8.1 veya daha yüksek bir sürüm gereklidir ve aşağıdaki eklentilerin yüklü olması gerekir:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!UYARI]
> PHP 7.4 için yaşam sonu tarihi 28 Kasım 2022 idi.
> PHP 8.0 için yaşam sonu tarihi 26 Kasım 2023 idi.
> Hala PHP 7.4 veya 8.0 kullanıyorsanız, hemen yükseltme yapmalısınız.
> PHP 8.1 için yaşam sonu tarihi 25 Kasım 2024 olacaktır.

Ayrıca, PHP'nizde aşağıdaki eklentilerin etkinleştirildiğinden emin olun:

- json (varsayılan olarak etkin - devre dışı bırakmayın)
- MySQL kullanmayı planlıyorsanız [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- HTTP\CURLRequest kütüphanesini kullanmayı planlıyorsanız [libcurl](http://php.net/manual/en/curl.requirements.php)

