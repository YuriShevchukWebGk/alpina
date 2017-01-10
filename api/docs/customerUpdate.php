<?include('api_header.php')?>
        <div class="api_content">
            <h2>update</h2>
            <div class="method_desc">
               Обновляет данные пользователя по его ID
            </div>
             <h2>URL для запроса</h2>
            <div class="url_ex">
                http://<?=$_SERVER['SERVER_NAME']?>/api/customer/
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
                    <td>update</td>
                    <td>Название вызываемого метода</td>
                </tr>
                <tr>
                    <td>token</td>
                    <td>обязательный</td>
                    <td>123456789qwertyuiopasdfghjklzxcv</td>
                    <td>Уникальный 32-х значный ключ-идентификатор для доступа к API</td>
                </tr>
                <tr>
                    <td>customer_id</td>
                    <td>обязательный</td>
                    <td>1</td>
                    <td>ID пользователя</td>
                </tr>
                <tr>
                    <td>data</td>
                    <td>обязательный</td>
                    <td>{"name":"Петр","email":"test@mail.com"}</td>
                    <td>Данные для обновления вида поле => значение. В формате JSON.</td>
                </tr>
            </table>
           
            
            <h2>Пример запроса методом GET</h2>
            
            <div class="code_example">
                <code>http://<?=$_SERVER['SERVER_NAME']?>/api/customer/?method=update&token=123456789qwertyuiopasdfghjklzxcv&customer_id=1&data={"name":"Петр","email":"test@mail.com"}</code>
            </div>
            
            <h2>Пример запроса методом POST на языке PHP</h2>
            
            <div class="code_example">
            <pre>
    $postdata = http_build_query(
        array(
           'method' => 'update',
           'token' => '123456789qwertyuiopasdfghjklzxcv',
           'customer_id' => '1',
           'data' => '{"name":"Петр","email":"test@mail.com"}'
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
    $result = file_get_contents('http://<?=$_SERVER['SERVER_NAME']?>/api/customer/', false, $context);
    
    print_r($result);</pre>
            </div>
            
            <h2>Пример ответа</h2>
            
             <div class="code_example">
                <pre>
{
  "success": "Пользователь успешно обновлен."
}                </pre>
             </div>
            
        </div>

<?include('api_footer.php')?>