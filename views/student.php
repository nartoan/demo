<?php require_once "views/commons/header.php"; ?>
    <div class="form-group container-search">
        <form action="index.php" method="get">
            <input type="text" name="name" class="input-search form-control" placeholder="Tên sinh viên" 
                value="<?php echo isset($search_key) ? $search_key : ""; ?>" />
            <span class="input-group-prepend">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </span>
        </form>
    </div>
    <div class="container-add">
        <a href="index.php?action=student-add" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus"></span>  Thêm sinh viên
        </a>
    </div>
    <div id="toys-grid">
        <table cellpadding="10" cellspacing="1" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th><strong>Tên sinh viên</strong></th>
                    <th><strong>Điểm</strong></th>
                    <th><strong>Ngày sinh</strong></th>
                    <th><strong>Lớp</strong></th>
                    <th><strong>Hành Động</strong></th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (! empty($result['data'])) {
                    foreach ($result['data'] as $k => $v) {
                ?>
                    <tr>
                        <td><?php echo $result['data'][$k]["name"]; ?></td>
                        <td><?php echo $result['data'][$k]["grade"]; ?></td>
                        <td><?php echo $result['data'][$k]["dob"]; ?></td>
                        <td><?php echo $result['data'][$k]["class"]; ?></td>
                        <td>
                            <a class="btnEditAction" href="index.php?action=student-edit&id=<?php echo $result['data'][$k]["id"]; ?>">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a class="btnDeleteAction" href="index.php?action=student-delete&id=<?php echo $result['data'][$k]["id"]; ?>">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    </tr>
                <?php
                    }
                }
                ?>
            <tbody>
        </table>

        <?php
            $base_url = "index.php?";
            $current_query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
            $query = explode("&",$current_query);

            foreach ($query as $value) {
                if (strpos($value, "name") !== false) {
                    $base_url = $base_url.$value."&";
                }
            }

            $max_page = ceil($result['count'] / $result['limit']);
            $class_previous = $result['page'] == 1 ? "disabled" : "";
            $url_previous = $result['page'] == 1 ? "" : $base_url."page=".($result['page'] - 1);
            $url_start = $result['page'] == 1 ? "" : $base_url."page=1";

            $class_next = $result['page'] == $max_page ? "disabled" : "";
            $url_next = $result['page'] == $max_page ? "" : $base_url."page=".($result['page'] + 1);
            $url_end = $result['page'] == $max_page ? "" : $base_url."page=".$max_page;

            $start_item_position = ($result['page']-1) * $result['limit'] + 1;
            $end_item_position = $result['page'] == $max_page ? $result['count'] : $result['page'] * $result['limit'];

        ?>
        <div class="container">
            
            <div class="paginate-custom">
                <span>
                    Items per page: <?php echo  $result['limit']; ?>
                </span>
                <span class="paginate-info">
                    <?php echo $start_item_position."-".$end_item_position." of ".$result['count']; ?>
                </span>
                <ul class="pagination">
                    <li class=<?php echo $class_previous; ?>>
                        <a href=<?php echo $url_start; ?>><<</a>
                    </li>
                    <li class=<?php echo $class_previous; ?>>
                        <a href=<?php echo $url_previous; ?>><</a>
                    </li>
                    <li class="active"><a href=><?php echo $result['page']; ?></a></li>
                    <li class=<?php echo $class_next; ?>>
                        <a href=<?php echo $url_next; ?>>></a>
                    </li>
                    <li class=<?php echo $class_next; ?>>
                        <a href=<?php echo $url_end; ?>>>></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php require_once "views/commons/footer.php"; ?>