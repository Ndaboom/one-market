<?php 
    $title = "Liste des utilisateurs";
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
                                            <li class="breadcrumb-item active">Clients</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Clients</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Clients</h4>
                                        <p class="text-muted font-13 mb-4">
                                            La liste des clients enregistrés dans le systeme
                                            <code></code>.
                                        </p>

                                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Telephone</th>
                                                    <th>Adresse</th>
                                                    <th>Magasin</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($users as $user): ?>
                                                <?php 
                                                    $shop = find("operators_tb", $user['shop_id']);
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php if(!empty($user['first_name'])): ?>
                                                        <?= $user['first_name'] ?> <?= $user['last_name'] ?>
                                                        <?php else: ?>
                                                        <?= $user['username'] ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= $user['phone_number'] ?></td>
                                                    <td><?= $user['adress'] ?></td>
                                                    <td><?= $shop ? $shop['operator_name'] : "n'est relier a aucune boutique" ?></td>
                                                    <td><a href="dashboard/create_user?u_i=<?= $user['id'] ?>" class="btn btn-xs btn-info">Modifier</a> <a class="btn btn-xs btn-danger">Supprimer</a></td>
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
