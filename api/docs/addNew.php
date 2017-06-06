<?include('api_header.php')?>
        <div class="api_content">
            <h2>addNew</h2>
            <div class="method_desc">
               Добавляет пользователя с email и паролем
            </div>
             <h2>URL для запроса</h2>
            <div class="url_ex">
                http://<?=$_SERVER['SERVER_NAME']?>/api/user/
            </div>
            <h2>Формат ответа</h2>
            <div class="resp_ex">
                JSON
            </div>
            <h2>Параметры</h2>
            <table class="params_table">
                <tr>
                    <th>Название</th>
                    <th></th>
                    <th>Пример значения</th>
                    <th>Описание</th>
                </tr>
                <tr>
                    <td>method</td>
                    <td>обязательный</td>
                    <td>addNew</td>
                    <td>Название вызываемого метода</td>
                </tr>
                <tr>
                    <td>token</td>
                    <td>обязательный</td>
                    <td>123456789qwertyuiopasdfghjklzxcv</td>
                    <td>Уникальный 32-х значный ключ-идентификатор для доступа к API</td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>обязательный</td>
                    <td>test@test.ru</td>
                    <td>Почтовый адрес пользователя</td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>обязательный</td>
                    <td>123456</td>
                    <td>Пароль пользователя в открытом виде. Мин. длина 6 символов.</td>
                </tr>
            </table>
           
            
            <h2>Пример запроса методом GET</h2>
            
            <div class="code_example">
                <code>http://<?=$_SERVER['SERVER_NAME']?>/api/user/?method=addNew&token=123456789qwertyuiopasdfghjklzxcv&email=test@test.ru&password=123456</code>
            </div>
            
            <h2>Пример запроса методом POST на языке PHP</h2>
            
            <div class="code_example">
            <pre>
    $postdata = http_build_query(
        array(
           'method' => 'addNew',
           'token' => '123456789qwertyuiopasdfghjklzxcv',
           'email' => 'test@test.ru',
           'password' => '123456'
       )
    );

    $opts = array('http' =>
       array(
           'method'  => 'POST',
           'header'  => 'Content-type: application/x-www-form-urlencoded',
           'content' => $postdata
      )
    );
    
    $context  = stream_context_create($opts);
    $result = file_get_contents('http://<?=$_SERVER['SERVER_NAME']?>/api/user/', false, $context);
    
    print_r($result);
            </pre>
            </div>
            
            <h2>Пример ответа</h2>
            
             <div class="code_example">
                <pre>
{
  "success": "Пользователь успешно добавлен"
}
                </pre>
             </div>
            
        </div>

<?include('api_footer.php')?>