<?php



?>





<table class="table table-dark table-striped">
  <tr>
    <th width="10%">STT</th>
    <th>Tên</th>
    <th>Email</th>
    <th width="10%">Sửa</th>
    <th width="10%">Xóa</th>
  </tr>

  <?php
    foreach ($users as $key => $value):
  ?>
  <tr>
    <td><?php echo $key+1 ?></td>
    <td><?php echo $value['fullname'] ?></td>
    <td><?php echo $value['email'] ?></td>
    <td>
        <a href="?url=user-edit&id=<?php echo $value['id'] ?>" class="btn btn-warning">Sửa</a>
    </td>
    <td>
        <a onclick="return confirm('bạn có chắc muốn xóa')" href="?url=user-delete&id=<?php echo $value['id'] ?>" class="btn btn-danger">Xóa</a>
    </td>
    </tr>
    <?php
    endforeach;
    ?>
</table>

<hr>
<a href="?url=user-add" class="btn btn-primary">Thêm</a>
