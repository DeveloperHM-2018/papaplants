<?php include('includes/header.php'); ?>
<div class="holder">
    <style>
        .dt-button {
            padding: 9px;
            border: 1px solid;
            margin: 10px;
        }
    </style>
    <?php include('includes/top-header.php'); ?>
    <main>
        <div class="container-fluid site-width">
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0"></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                    if ($this->session->has_userdata('msg')) {
                        echo $this->session->userdata('msg');
                        $this->session->unset_userdata('msg');
                    }
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display table dataTable table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S. No</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Village</th>
                                            <th>Legislative Assembly</th>
                                            <th>MLA Name</th>
                                            <th>districts </th>
                                            <th>Age </th>
                                            <!-- <th>Gender </th> -->
                                            <!-- <th>
                                                Now, I will ask about some facilities in your city. Tell me if in the last five years the facilities have improved, deteriorated or remained the same?
                                            </th> -->
                                            <th>Which party did you vote for last time? </th>
                                            <th>Do you or your acquaintances get support from the sitting MLA? </th>
                                            <th>Which party do you want to vote for this time? </th>
                                            <th>Keeping in mind the strength with which AIMIM leader Owaisi ji fights in favour of the minority community in the country, will you support his party in the upcoming elections? </th>
                                            <th>According to you, which party is likely to win from your seat in the upcoming elections?</th>
                                            <th>
                                                According to you, which of these candidates is likely to win your assembly seat?
                                            </th>
                                            <th>Favors AIMIM?</th>
                                            <!-- <th>Interviewer’s Name:</th>
                                            <th>Interviewer’s Number </th> -->
                                            <!-- <th>Geo Location </th> -->
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($opinion)) {
                                            $i = $j = 0;
                                            foreach ($opinion as $row) {
                                                $i = $i + 1;
                                                $dash = '';
                                                // $facilities = getAllRow('facilities');
                                                // if (!empty($facilities)) {
                                                //     foreach ($facilities as $rowss) {
                                                //         $j = $j+1;
                                                //         $fac = getRowByMoreId('facilities_review', array('user_id' => $row['id'], 'facility' => $rowss['fid']));
                                                //         $dash .=  $j . '&nbsp;' . $rowss['name']  . '<br>' . 'Group1-' . $fac[0]['groupa_review'] . '<br>' . 'Group2-' . $fac[0]['review'] . '<br> <br>' ;
                                                //     }
                                                // }
                                        ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= convertDatedmy($row['create_date']); ?></td>
                                                    <td><?= $row['name'] ?></td>
                                                    <td><?= $row['village'] ?></td>
                                                    <td><?= $row['assembly'] ?></td>
                                                    <td><?= $row['mla_name'] ?></td>
                                                    <td><?= $row['district'] ?></td>
                                                    <td><?= $row['age'] ?></td>
                                                    <!-- <td><?= $row['gender'] ?></td> -->
                                                    <!-- <td>
                                                        <?= $dash ?>
                                                    </td> -->
                                                    <td><?= $row['vote_party'] ?></td>
                                                    <td><?= $row['change_sitting_mla'] ?></td>
                                                    <td><?= $row['support_from_mla'] ?></td>
                                                    <td><?= $row['party_vote_this_time'] ?></td>
                                                    <td><?= $row['party_win'] ?></td>
                                                    <td><?= $row['candicate_win'] ?></td>
                                                    <td><?= $row['favors_AIMIM'] ?></td>
                                                    <!-- <td><?= $row['interviewer_name'] ?></td>
                                                    <td><?= $row['interviewer_number'] ?></td>
                                                     -->
                                                    <!-- <td><?= $row['location'] ?></td> -->
                                                    <!-- <td><a href="<?= base_url('form-detail/' . $row['id']) ?>"><button type="button" class="btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target=".orderdetailsModal">
                                                                View Details
                                                            </button></a></td> -->
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('includes/footer.php') ?>
    <?php include('includes/footer-link.php'); ?>
    </body>
    </html>
