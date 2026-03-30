<div class="footer-bottom-area footer-bg">
            <div class="container">
                <div class="footer-border" style="padding: 12px 0px 12px;">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-12 ">
                            <div class="footer-copy-right text-center">
                                <p class="m-0">
                                    Copyright &copy;
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script> All rights reserved |
                                    ICMR-NIIRNCD Jodhpur |
                               

                                    Page Updated on : <?php

                                                        $sql = "SELECT * from web_last_update_date ";
                                                        $query = $dbh->prepare($sql);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {                ?>
                                            <?php $newDateString = date_format(date_create_from_format('Y-m-d', $result->date), 'd/m/Y'); ?>
                                            <?php echo htmlentities($newDateString); ?>
                                    <?php $cnt = $cnt + 1;
                                                            }
                                                        } ?>
                                                        
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
