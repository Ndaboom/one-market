<?php 

$title = "Liste des sous-categories";

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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">One Market</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Sous-categories produits</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Sous-categories produits</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    
                                </div>
                                <div class="col-auto">
                                    <div class="text-lg-end my-1 my-lg-0">
                                        <a href="dashboard/create_sous_category" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-plus-circle me-1"></i> Ajouter nouvelle</a>
                                    </div>
                                </div><!-- end col-->
                            </div> <!-- end row -->
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col-->
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Sous-categories des produits</h4>
                            <p class="text-muted font-13 mb-4">
                                La liste des sous-categories pour un produit dans le systeme
                                <code></code>.
                            </p>

                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Designation</th>
                                        <th>Categorie parent</th>
                                        <th>Ajoutée le</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($sous_categories as $key=>$row): ?>
                                    <?php $category_details = fetch_category_details($row['parent_id']); ?>
                                    <tr>
                                        <td><?= $key ?></td>
                                        <td><?= $row['designation'] ?></td>
                                        <td><?= $category_details['designation'] ?></td>
                                        <td><?= $row['created_at'] ?></td>
                                        <td>
                                        <a href="dashboard/create_sous_category?sc_i=<?= $row['id'] ?>" class="btn btn-xs btn-info">Modifier</a> 
                                                    <?php if($row['status'] == 1): ?>
                                                    <a class="btn btn-xs btn-danger" href="dashboard/change_scategory_status?sc_i=<?= $row['id'] ?>&status=0">Desactiver</a>
                                                    <?php else: ?>
                                                    <a class="btn btn-xs btn-success" href="dashboard/change_scategory_status?sc_i=<?= $row['id'] ?>&status=1">Activer</a>
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
