<li><a href="?<?php echo paramEncrypt('hal=member-home')?>"><i class="fa fa-home"></i> Home</a></li>
<li><a href="?<?php echo paramEncrypt('hal=member-order-input')?>"><i class="fa fa-file-text-o"></i> Order</a></li> 
<li><a href="?<?php echo paramEncrypt('hal=member-shipment-input')?>"><i class="fa fa-file-text-o"></i> Shipment</a></li>
<li><a href="?<?php echo paramEncrypt('hal=member-paid-unpaid')?>"><i class="fa fa-usd"></i> Paid and Unpaid</a></li>
<li><a href="?<?php echo paramEncrypt('hal=member-retailer-list')?>"><i class="fa fa-chain"></i> Retailer</a></li>
<li><span class="fa fa-chevron-down"></span><a><i class="fa fa-file-pdf-o"></i> Report</a>
    <ul class="nav child_menu" style="display: none">
        <li><a href="?<?php echo paramEncrypt('hal=member-report-outstanding-payment')?>">Payment Status </a></li>
        <li><a href="?<?php echo paramEncrypt('hal=member-report-trees-planted')?>">Trees Planted </a></li>
        <!-- <li><a href="?<?php echo paramEncrypt('hal=member-report-contribution')?>">Contribution</a> -->
        <!-- <li><a href="?<?php echo paramEncrypt('hal=member-report-win')?>">WIN</a></li> -->
    </ul>
</li>
