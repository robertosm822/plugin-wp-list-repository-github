<h4>Widget:</h4>
<label for="user">Usuário: </label><br>
<input type="text" name="<?php echo $this->get_field_name('user_github');?>" id="<?php echo $this->get_field_id('user_github');?>" value="<?php echo $user;?>"><br>
<label for="user">Quantidade repositórios: </label><br>
<input type="text" name="<?php echo $this->get_field_name('qtd_github');?>" id="<?php echo $this->get_field_id('qtd_github');?>" value="<?php echo $qtd;?>"><br>