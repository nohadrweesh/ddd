<form method="post" action="/schools">
    {{csrf_field()}}
    <input type="text" placeholder="Type school Name" name="name">
    <input type="submit" value="Insert School"/>
    
    
</form>