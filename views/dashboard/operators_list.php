<?php 

    $title = "Liste des operateurs";

?>

<div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                            <li class="breadcrumb-item active">Magasins</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Magasins / Operateurs</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Les Magasins</h4>
                                        <p class="text-muted font-13 mb-4">
                                            La liste des magasins ou operateurs enregistrés dans le systeme
                                            <code></code>.
                                        </p>

                                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Categorie</th>
                                                    <th>Produits</th>
                                                    <th>Pays</th>
                                                    <th>Province</th>
                                                    <th>Ville</th>
                                                    <th>Adresse</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($operators as $operator): ?>
                                                <?php 
                                                    $country = find("countries", $operator['id']);
                                                    $state = find("states", $operator['operator_state']);
                                                    $city = find("cities", $operator['operator_city']);
                                                    $products = verify_existing_data("products_tb", "shop_id", $operator['id']);
                                                ?>
                                                <tr>
                                                    <td><?= $operator['operator_name'] ?></td>
                                                    <td><?= $operator['operator_category'] ?></td>
                                                    <td> <?= count($products) != 0 ? count($products) : "0" ?> </td>
                                                    <td><?= $country['name'] ?></td>
                                                    <td><?= $state['name'] ?></td>
                                                    <td><?= $city['name'] ?></td>
                                                    <td><?= $operator['operator_adress'] ?></td>
                                                    <td><a href="dashboard/create_operator?op_i=<?= $operator['id'] ?>" class="btn btn-xs btn-info">Modifier</a> 
                                                    <?php if($operator['operator_status'] == "active"): ?>
                                                    <a class="btn btn-xs btn-danger" href="dashboard/change_operator_status?op_i=<?= $operator['id'] ?>&status=deactivate">Desactiver</a>
                                                    <?php else: ?>
                                                    <a class="btn btn-xs btn-success" href="dashboard/change_operator_status?op_i=<?= $operator['id'] ?>&status=active">Activer</a>
                                                    <?php endif; ?>
                                                </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->
                    </div>
                </div>
</div>
