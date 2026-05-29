    <?php
    session_start();

    $aksesUser  = $_SESSION['user']['akses'] ?? null;
    $semuaAkses = ($aksesUser === null);

    function bolehMenu($menu, $aksesUser, $semuaAkses)
    {
        return $semuaAkses || in_array($menu, (array)$aksesUser, true);
    }
    ?>
    <div id="second-content">
        <div class="d-flex flex-column m-1 text-center">
            <div class="row ">
                <div class="col mt-2">
                    <div class="card card-hov <?= !bolehMenu('data_material', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>">
                        <div class="card-body <?= !bolehMenu('data_material', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="material" data-akses="data_material">
                            <i class="bi bi-box-seam fs-1"></i>
                            <h5 class="card-title">Material</h5>
                        </div>
                    </div>
                </div>

                <div class="col mt-2">
                    <div class="card card-hov <?= !bolehMenu('data_purchase_order', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>">
                        <div class="card-body <?= !bolehMenu('data_purchase_order', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="purchase_order" data-akses="data_purchase_order">
                            <i class="bi bi-clipboard2-data fs-1"></i>
                            <h5 class="card-title">Purchase Order</h5>
                        </div>
                    </div>
                </div>

                <div class="col mt-2">
                    <div class="card card-hov <?= !bolehMenu('data_invoice', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>">
                        <div class="card-body <?= !bolehMenu('data_invoice', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="invoice" data-akses="data_invoice">
                            <i class="bi bi-cash-stack fs-1"></i>
                            <h5 class="card-title">Invoice</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col mt-2">
                    <div class="card card-hov <?= !bolehMenu('data_customer_supplier', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>">
                        <div class="card-body <?= !bolehMenu('data_customer_supplier', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="customer_supplier" data-akses="data_customer_supplier">
                            <i class="bi bi-building fs-1"></i>
                            <h5 class="card-title">Customer & Supplier</h5>
                        </div>
                    </div>
                </div>

                <div class="col mt-2">
                    <div class="card card-hov <?= !bolehMenu('data_in_out_material', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>">
                        <div class="card-body <?= !bolehMenu('data_in_out_material', $aksesUser, $semuaAkses) ? 'disabled' : '' ?>" id="in_out_material" data-akses="data_in_out_material">
                            <i class="bi bi-truck fs-1"></i>
                            <h5 class="card-title">In Out Material</h5>
                        </div>
                    </div>
                </div>

                <div class="col mt-2">
                </div>
            </div>
        </div>
    </div>
    <div id="third-content"></div>
    <div id="fourth-content"></div>
    <script>
        if (!document.getElementById('custom-style-data')) {

            const customStyleData = document.createElement('style');
            customStyleData.id = 'custom-style-data';

            customStyleData.textContent = `
            .card-hov.disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            .card-body.disabled {
                opacity: 0.5;
                cursor: not-allowed !important;
            }
        `;

            document.head.appendChild(customStyleData);
        }

        function ts() {
            return '?_=' + Date.now();
        }

        $("#material").click(function() {
            if ($(this).hasClass('disabled')) {
                return;
            }
            $("#second-content").hide();
            $("#third-content").load("view/material.php");
        });
        $("#purchase_order").click(function() {
            if ($(this).hasClass('disabled')) {
                return;
            }
            $("#second-content").hide();
            $("#third-content").load("view/purchase_order.php" + ts());
        });
        $("#invoice").click(function() {
            if ($(this).hasClass('disabled')) {
                return;
            }
            $("#second-content").hide();
            $("#third-content").load("view/invoice.php" + ts());
        });
        $("#customer_supplier").click(function() {
            if ($(this).hasClass('disabled')) {
                alert('❌ .');
                return;
            }
            $("#second-content").hide();
            $("#third-content").load("view/customer_supplier.php" + ts());
        });
        $("#in_out_material").click(function() {
            if ($(this).hasClass('disabled')) {
                alert('❌ .');
                return;
            }
            $("#second-content").hide();
            $("#third-content").load("view/in_out_material.php" + ts());
        });
    </script>