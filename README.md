# <center>Laravel Passport API Routes</center>
#### <center>Пакет для приложения Laravel с реализацией авторизации Creating A Password Grant Client для пакета PASSPORT настроенными маршрутами для API</center>

- _Устанавливает и настраивает маршруты для регистрации с подтверждением по Email._
- _Маршруты для Логина, восстановления и сброса пароля, также с подтверждением Email._

#### <center>Устанавливаются уже настроенные маршруты для использования API:</center>

- Авторизация: POST http://localhost/api/login
- Регистрации: POST http://localhost/api/register
- Обработчик проверки электронной почты: GET http://localhost/api/email/verify/{id}
- Перезапрос токена проверки электронной почты: GET http://localhost/api/email/resend
- Запрос на сброс пароля: POST http://localhost/api/forgot-password
- Ссылка для обработки токена с почты: GET http://localhost/api/reset-password/{token}
- Смена пароля: POST http://localhost/api/reset-password

## Предварительные требования:

#### **1) Установленный и настроенный пакет Passport** _https://github.com/laravel/passport_
- ### Установленные переменные окружения в .env файле
  - >APP_URL=http://localhost (по умолчанию http://localhost)
  - >PASSPORT_CLIENT_SECRET=_2_ (по умолчанию - _2_)
  - >PASSPORT_CLIENT_SECRET=_l5VoxzUGbXrKh2jvNtQAwji7p2ImXcSMdv4rwCZ6_ (_обязательно установить_)
## <center>Получение значений для </center>

### <center><span style="color: green;">PASSPORT_CLIENT_SECRET</span> и <span style="color: green;">PASSPORT_CLIENT_SECRET</span></center>
#### Сначала устанавливаем пакет Passport через composer командой 
- >_composer require laravel/passport_

#### Далее выполняем миграции
- >_php artisan migrate_
  
_Далее вам следует выполнить passport:install команду Artisan. Эта команда создаст ключи шифрования, необходимые для создания токенов безопасного доступа. Кроме того, команда создаст клиентов «персонального доступа» и «предоставления пароля», которые будут использоваться для генерации токенов доступа:_

-  >_php artisan passport:install_
   
**_Нам нужны токены «предоставления пароля»_**
### Получим подобный результат:

- **Encryption keys generated successfully.**
- >#### Personal access client created successfully.
  Client ID: _1_

  ~~Client secret: _sKbfWQiq4t28kTSZs1EOcJMsCsMK8ditgcmtQ0HC_~~
- >#### Password grant client created successfully.
  Client ID: _2_

  Client secret: _l5VoxzUGbXrKh2jvNtQAwji7p2ImXcSMdv4rwCZ6_
### Нам нужны именно:
>Password grant client created successfully.
>- Client ID: _2_
>- Client secret: _l5VoxzUGbXrKh2jvNtQAwji7p2ImXcSMdv4rwCZ6_


