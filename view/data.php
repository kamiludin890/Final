<div id="second-content">
    <div class="d-flex flex-column m-1 text-center">
        <div class="row ">
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="material">
                        <i class="bi bi-box-seam fs-1"></i>
                        <h5 class="card-title">Material</h5>
                    </div>
                </div>
            </div>
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="purchase_order">
                        <i class="bi bi-clipboard2-data fs-1"></i>
                        <h5 class="card-title">Purchase Order</h5>
                    </div>
                </div>
            </div>
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="invoice">
                        <i class="bi bi-cash-stack fs-1"></i>
                        <h5 class="card-title">Invoice</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="customer_supplier">
                        <i class="bi bi-building fs-1"></i>
                        <h5 class="card-title">Customer & Supplier</h5>
                    </div>
                </div>
            </div>
            <div class="col mt-2">
                <div class="card card-hov">
                    <div class="card-body" id="in_out_material">
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
    $("#material").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/material.php");
    });
    $("#purchase_order").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/purchase_order.php");
    });
    $("#invoice").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/invoice.php");
    });
    $("#customer_supplier").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/customer_supplier.php");
    });
    $("#in_out_material").click(function() {
        $("#second-content").hide();
        $("#third-content").load("view/in_out_material.php");
    });
</script>