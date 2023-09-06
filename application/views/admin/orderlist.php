 <div class="table-responsive">
     <table id="bs4-table" class="table table-striped table-bordered" style="width: 100%">
         <thead>
             <tr>
                 <th>S.N.</th>
                 <th>Contact details </th>
                 <th>Payment <br> Details</th>
                 <th>Grand total</th>
                 <th>View details</th>
                 <th>Order Status</th>
                 <th>Delete </th>
             </tr>
         </thead>
         <tbody>
             <?php
                $i = 1;
                if (!empty($checkout)) {
                    foreach ($checkout as $row) {
                        // print_r($row);
                ?>
                     <tr>
                         <td><?php echo $i; ?></td>
                         <td style="word-wrap: break-word;">Order date - <?php echo convertDatedmy($row['create_date']); ?>
                             <br><?php echo $row['name']; ?><br>Cont. - <?php echo $row['number']; ?><br>Add. - <?php echo $row['address']; ?>
                         </td>
                         <td><?php echo (($row['razorpay_payment_id'] == '') ? '<a href="#" class="btn btn-warning">Payment Pending</a> ' : $row['razorpay_payment_id']); ?></td>
                         <td><?php echo $row['grand_total']; ?></td>
                         <td><a href="<?php echo base_url() . 'admin_Dashboard/OrderPlacedDetails/' . $row['id']; ?>" class="btn btn-danger edit"><i class="fas fa-eye"></i></a></td>
                         <td>
                             <!-- Modal -->
                             <div class="modal fade" id="exampleModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                     <div class="modal-content">
                                         <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">
                                                 Update status
                                             </h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                             </button>
                                         </div>
                                         <form action="<?= base_url('admin_Dashboard/statusupdate') ?>" method="POST">
                                             <div class="modal-body">
                                                 <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                                 <select name="status" class="form-control">
                                                     <option value="0">New</option>
                                                     <option value="1">On-working</option>
                                                     <option value="2">Cancelled and refunded</option>
                                                     <option value="3">Completed</option>
                                                     <!--<option value="">On-working</option>-->
                                                 </select>
                                             </div>
                                             <div class="modal-footer">
                                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                 <button type="submit" class="btn btn-primary">Save changes</button>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                             <button type="button" data-toggle="modal" data-target="#exampleModal<?= $row['id'] ?>" class="btn btn-<?= (($row['status'] == 0) ? 'info' : (($row['status'] == 1) ? 'warning' : (($row['status'] == 2) ? 'danger' : (($row['status'] == 3) ? 'success' : (($row['status'] == 4) ? 'warning' : 'secondary'))))) ?>"> <?= (($row['status'] == 0) ? 'New order' : (($row['status'] == 1) ? 'On the way' : (($row['status'] == 2) ? 'Cancelled' : (($row['status'] == 3) ? 'Order completed' : (($row['status'] == 4) ? 'cancel requested' : ''))))) ?>
                             </button>
                         </td>
                         <td><a href="<?php echo base_url() . 'admin_Dashboard/orderdelete/' . $row['id']; ?>" class="btn btn-danger delete"><i class="fas fa-trash"></i></a></td>
                     </tr>
             <?php
                        $i++;
                    }
                }
                ?>
         </tbody>
     </table>
 </div>
