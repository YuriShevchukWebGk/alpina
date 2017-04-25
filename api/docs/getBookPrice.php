<?include('api_header.php')?>
        <div class="api_content">
            <h2>getBookPrice</h2>
            <div class="method_desc">
               Получить цену книги
            </div>
             <h2>URL для запроса</h2>
            <div class="url_ex">
                https://<?=$_SERVER['SERVER_NAME']?>/api/book/
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
                    <td>getBookPrice</td>
                    <td>Название вызываемого метода</td>
                </tr>
                <tr>
                    <td>token</td>
                    <td>обязательный</td>
                    <td>123456789qwertyuiopasdfghjklzxcv</td>
                    <td>Уникальный 32-х значный ключ-идентификатор для доступа к API</td>
                </tr>
                <tr>
                    <td>id</td>
                    <td>обязательный</td>
                    <td>1</td>
                    <td>ID книги</td>
                </tr>
            </table>
           
            
            <h2>Пример запроса методом GET</h2>
            
            <div class="code_example">
                <code>https://<?=$_SERVER['SERVER_NAME']?>/api/book/?method=getBookPrice&token=123456789qwertyuiopasdfghjklzxcv&id=1</code>
            </div>
            
            <h2>Пример запроса методом POST на языке PHP</h2>
            
            <div class="code_example">
            <pre>
    $postdata = http_build_query(
        array(
           'method' => 'getBookPrice',
           'token' => '123456789qwertyuiopasdfghjklzxcv',
           'id' => '1'
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
    $result = file_get_contents('https://<?=$_SERVER['SERVER_NAME']?>/api/book/', false, $context);
    
    print_r($result);
            </pre>
            </div>
            
            <h2>Пример ответа</h2>
            
             <div class="code_example">
                <pre>
{
  "success": "285.00"
}
                </pre>
             </div>
            
        </div>

<?include('api_footer.php')?>