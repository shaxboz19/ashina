<a href="<?=site_url('admin/contacts/')?>">назад</a>   
<br/>
   <fieldset>
        <legend>Информация</legend>
        <h5>Время:</h5> <?=date('d-m-Y H:i', strtotime($contact->date))?>
        <h5>ФИО: </h5><?=$contact->name?>
        <h5>Телефон: </h5><?=$contact->phone?>
        <h5>Email:</h5> <?=$contact->email?> 
        <h5>Сообщение:</h5> <?=$contact->message?>
</fieldset>
<br/>

