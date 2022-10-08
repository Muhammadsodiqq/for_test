<?php require '../fetch.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>

<div class="container mt-3">
    <div class="row">
        <div class="col-12 mb-3">
            <p id="count">Sahifa <strong><?php echo $page ?></strong> jami <strong><?php echo $data['count'] ?></strong>
            </p>
        </div>
        <div class="col-12">
                <table class="table table-bordered text-center  ">
                    <thead>
                    <tr>
                        <th>ID
                            <button class="btn btn-primary sortbutton btn-sm" sort='id'>sort</button>
                        </th>
                        <th>First name
                            <button class=" btn btn-primary sortbutton btn-sm" sort='first_name'>sort</button>
                        </th>
                        <th>Last name
                            <button class="btn btn-primary sortbutton btn-sm" sort='last_name'>sort</button>
                        </th>
                        <th>Email
                            <button class="btn btn-primary sortbutton btn-sm" sort='email'>sort</button>
                        </th>
                        <th colspan="2">Brithday
                            <button class="btn btn-primary sortbutton btn-sm"
                                    sort='birth_date'>sort
                            </button>
                        </th>
                        <th>Status
                            <button class="btn btn-primary sortbutton btn-sm" sort='status'>sort</button>
                        </th>
                        <th colspan="3">Harakat</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <tr>
                        <td><input class="form-control" placeholder="Search ID" name="id" id="search" type="text"></td>
                        <td><input class="form-control" placeholder="Search name" name="first_name" id="search" type="text"></td>
                        <td><input class="form-control" placeholder="Search last name" name="last_name" id="search" type="text"></td>
                        <td><input class="form-control" placeholder="Search email" name="email" id="search" type="text"></td>
                        <td><input class="form-control" for placeholder=""  id="search" min="1997-01-01" max="2030-12-31" name="birsth_date" type="date"></td>
                        <td><input class="form-control" placeholder="" id="search" name="to_date" min="1997-01-01" max="2030-12-31" type="date"></td>
<!--                        <td><input class="form-control" placeholder="Search status" name="status" id="search" type="text"></td>-->
                        <td>
                            <select id="search" class="form-select">
                                <option value="">select</option>
                                <option value="1">active</option>
                                <option value="0">unactive</option>
                            </select>
                        </td>
                        <td colspan="3">
                            <input class="form-control bg-success text-white" id="search-submit" type="submit" value="search">
                        </td>
                    </tr>
                    <tbody id="main-body">
                    <?php foreach ($data["data"] as $value) { ?>
                        <tr>
                            <th scope="row"><?php echo $value['id']; ?></th>
                            <td><?php echo $value['first_name']; ?></td>
                            <td><?php echo $value['last_name']; ?></td>
                            <td><?php echo $value['email']; ?></td>
                            <td colspan="2"><?php echo $value['birth_date']; ?></td>
                            <td><?php echo $value['status'] == 0 ? "unactive" : "active"; ?></td>
                            <td>harakat</td>

                        </tr>

                    <?php } ?>
                    </tbody>

                    </tbody>
                </table>

        </div>
        <div class="col-12 mt-3 d-flex justify-content-center">
            <nav aria-label="...">
                <ul class="pagination">
                    <?php
                    foreach (range(1, ceil($data['total_pages'])) as $item) {
                        ?>
                        <li class="page-item">
                            <a href="?page=<?php echo $item ?>&limit=10"
                               class="page-link <?php echo $page == $item ? 'active' : '' ?>"><?php echo $item ?></a>
                        </li>

                    <?php } ?>

                </ul>
            </nav>
        </div>
    </div>
</div>
<script src="main.js"></script>

</body>
</html>