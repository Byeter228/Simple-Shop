<!-- Modal Edit-->
<div class="modal fade" id="editModal<?=$value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Редактировать пользователя № <?=$value['id'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="?id=<?=$value['id'] ?>" method="post">
        	<div class="form-group">
        		<input type="text" class="form-control" name="edit_name" value="<?=$value['name'] ?>" placeholder="Никнейм">
        	</div>
          <div class="form-group">
        		<input type="text" class="form-control" name="edit_email" value="<?=$value['email'] ?>" placeholder="Почта">
        	</div>
        	<div class="form-group">
        		<input type="text" class="form-control" name="edit_password" value="<?=$value['password'] ?>" placeholder="Пароль">
        	</div>
        	<div class="form-group">
        		<input type="text" class="form-control" name="edit_contact" value="<?=$value['contact'] ?>" placeholder="Номер Телефона">
        	</div>
          <div class="form-group">
        		<input type="text" class="form-control" name="edit_city" value="<?=$value['city'] ?>" placeholder="Город">
        	</div>
          <div class="form-group">
        		<input type="text" class="form-control" name="edit_address" value="<?=$value['address'] ?>" placeholder="Адрес">
        	</div>
          <div class="form-group">
        		<input type="text" class="form-control" name="edit_perms" value="<?=$value['perms'] ?>" placeholder="Уровень доступа" list="perms_list">
        	    <datalist id="perms_list">
                  <option value="ADMIN">
                  <option value="ACCOUNTANT">
                  <option value="MANAGER">
                  <option value="STOREKEEPER">
                </datalist>
        	</div>
        	<div class="modal-footer">
        		<button type="submit" name="edit-submit" class="btn btn-primary">Обновить</button>
        	</div>
        </form>	
      </div>
    </div>
  </div>
</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal<?=$value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Удалить пользователя № <?=$value['id'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <form action="?id=<?=$value['id'] ?>" method="post">
        	<button type="submit" name="delete_submit" class="btn btn-danger">Удалить</button>
    	</form>
      </div>
    </div>
  </div>
</div>
