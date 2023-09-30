# <center>Laravel Passport API Routes</center>
#### <center>Пакет для приложения Laravel с реализацией авторизации Creating A Password Grant Client для пакета laravel/passport настроенными маршрутами для API</center>

- _Устанавливает и настраивает маршруты для регистрации с подтверждением по Email._
- _Маршруты для Логина, восстановления и сброса пароля, также с подтверждением Email._


- Пакет реализует стандартную модель пользователя в приложении Laravel.
- Модель пользователя находящаяся по умолчанию в приложении переопределена на автономную, которая определена в самом пакете.
- Регистрация с требуемыми полями: _username_, _email_, _password_, _password_confirmation_
- Авторизация с требуемыми полями: _username -> (email)_, _password_
- Авторизация возвращает токен доступа.


- **username**: ограничен 25 символами.
- **email**: ограничен 50 символами.
- **password**: минимальная требуемая длина 8 символов.

#### <center>Устанавливаются уже настроенные маршруты для использования API:</center>

>- Авторизация: POST http://localhost/api/login
>  - Принимает: 
>    - username: max:50 (в виде email)
>    - password: min:8
>  - Возвращает:
>    - Json response: authorization token


>- Регистрации: POST http://localhost/api/register
>  - Принимает:
>    - name: max:25
>    - email: max:50
>    - password: min:8
>  - Возвращает:
>    - Json response: "To confirm your registration, check your email!"


>- Обработчик проверки электронной почты: GET http://localhost/api/email/verify/{id}
>  - Принимает:
>    - адрес для верификации высланный на email
>  - Возвращает:
>    - В случае успешного завершения, переадресацию на [APP_FRONT_URL + AFTER_REGISTER_EMAIL_CONFIRMATION_ROUTE](http://localhost:4200/auth/login?verified=true) с JSON Response: "Your registration has been successfully confirmed! You can log in."
>    - В ином случае JSON Response: "Invalid or expired token specified!"


>- Перезапрос токена проверки электронной почты: POST http://localhost/api/email/resend
>  - Принимает:
>    - email: max:50
>  - Возвращает:
>    - Если такой email был зарегистрирован, то ссылку на email для подтверждения регистрации.
>    - Если такого email не регистрировалось, то JSON Response: "The user with this email is not registered!".
>    - Если email уже был подтвержден, то JSON Response: "Email has already been confirmed."


>- Запрос на сброс пароля: POST http://localhost/api/forgot-password
>  - Принимает:
>   - email: max:50
>  - Возвращает:
>    - Ссылку на email для сброса пароля.
>    - Иначе JSON Response: "This email address is not registered!"

- Ссылка для обработки токена с почты: GET http://localhost/api/reset-password/{token}
- Смена пароля: POST http://localhost/api/reset-password

### <span style="color: lightgreen;"><center>Установка пакета:</center></span>

> _<center>composer require yurchenko-andrew/laravel-passport-api-routes</center>_

## Предварительные требования:

### <center>Пакет "Laravel Passport" входит в зависимость пакета "Laravel Passport API Routes" и по этому вам не нужно его специально устанавливать отдельно</center>
- ### Установленные переменные окружения в .env файле
  > APP_URL=http://localhost (по умолчанию http://localhost)
  > 
  > PASSPORT_CLIENT=_2_ (по умолчанию - _2_)
  > 
  > PASSPORT_CLIENT_SECRET=_l5VoxzUGbXrKh2jvNtQAwji7p2ImXcSMdv4rwCZ6_ (не установлено  по умолчанию)
  > 
  > APP_FRONT_URL=http://localhost:4200 (по умолчанию http://localhost:4200)
  > 
  > AFTER_REGISTER_EMAIL_CONFIRMATION_ROUTE=[/auth/login?verified=true](http://localhost:4200/auth/login?verified=true) (по умолчанию [/auth/login?verified=true](http://localhost:4200/auth/login?verified=true))
## <center>Получение значений для </center>

### <center><span style="color: lightgreen;">PASSPORT_CLIENT</span> и <span style="color: lightgreen;">PASSPORT_CLIENT_SECRET</span></center>

#### После установки пакета выполняем миграции
>_php artisan migrate_
  
_Далее вам следует выполнить passport:install команду Artisan. Эта команда создаст ключи шифрования, необходимые для создания токенов безопасного доступа. Кроме того, команда создаст клиентов «персонального доступа» и «<span style="color: lightblue;">предоставления пароля</span>», которые будут использоваться для генерации токенов доступа:_

>_php artisan passport:install_
   
**_Нам нужны токены «<span style="color: lightblue;">предоставления пароля</span>»_**
### <center> Получим подобный результат:</center>

>_Encryption keys generated successfully._
>#### Personal access client created successfully.
>Client ID: _1_
>
>Client secret: _sKbfWQiq4t28kTSZs1EOcJMsCsMK8ditgcmtQ0HC_
>#### Password grant client created successfully.
>Client ID: _2_
> 
>Client secret: _l5VoxzUGbXrKh2jvNtQAwji7p2ImXcSMdv4rwCZ6_
### <center><span style="color: lightgreen;">Нам нужны именно:</span></center>
>#### Password grant client created successfully.
>- Client ID: _2_
>- Client secret: _l5VoxzUGbXrKh2jvNtQAwji7p2ImXcSMdv4rwCZ6_

#### <center>Устанавливаем переменные окружения в файл .env</center>
> APP_URL=http://api.backapp.com
> 
> APP_FRONT_URL=http://frontapp.com
> 
> AFTER_REGISTER_EMAIL_CONFIRMATION_ROUTE=/auth/login?verified=true
> 
> PASSPORT_CLIENT=2
> 
> PASSPORT_CLIENT_SECRET=l5VoxzUGbXrKh2jvNtQAwji7p2ImXcSMdv4rwCZ6

