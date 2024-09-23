<?php
include './db_con.php';
$acc_id = $_SESSION['acc_id'];

$sql = "SELECT 
            a.adoption_id,
            a.status,
            o.first_name, 
            o.last_name,
            o.orphan_id 
        FROM 
            adoptions AS a
        LEFT JOIN 
            orphan_list AS o ON o.orphan_id = a.orphan_id 
        WHERE 
            a.acc_id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $acc_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0): 
    while ($row = mysqli_fetch_assoc($result)): ?>
                <?php
                    $orphan_id = $row['orphan_id'];
                    $query4 = "SELECT org_list.org_name 
                                FROM org_list 
                                LEFT JOIN orphan_list ON org_list.org_id = orphan_list.org_id
                                WHERE orphan_list.orphan_id = $orphan_id ";
                    $result4 = mysqli_query($con, $query4);
                    $row4 = mysqli_fetch_assoc($result4);
                    $org_name = $row4['org_name'];
                ?>
            <div class="ag-courses_item">
                <a href="./U_adoption_request_details.php?adoption_id=<?php echo $row['adoption_id']; ?>" class="ag-courses-item_link">
                    <div class="ag-courses-item_bg"></div>
                    <div class="ag-courses-item_title">
                        <h1><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></h1>
                        <p><?php echo htmlspecialchars($org_name); ?></p>
                    </div>
                    <div class="ag-courses-item_date-box">
                        <span class="ag-courses-item_date">
                            <?php
                                if($row['status'] == 0){
                                    echo "Pending";
                                } else if($row['status'] == 1){
                                    echo "Approved";
                                } else {
                                    echo "Rejected";
                                }
                            ?>
                        </span>
                    </div>
                </a>
            </div>
    <?php endwhile; 
else: ?>
    <div class="no-request">
        <p id="notFound">No adoption request yet.</p>
    </div>
<?php endif; ?>
