<?php
	include("auth.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<script src="https://cdn.tailwindcss.com"></script>
		<title>Branch</title>

		<style>
			tr:nth-child(even) {
				background-color: #f2f2f2;
			}
			th,
			td {
				padding: 0.75rem;
				border-bottom-width: 2px;
				border-color: rgb(156 163 175);
				font-size: 1.125rem;
				line-height: 1.75rem;
			}
			body {
				background-color: rgb(229 231 235);
			}
		</style>
	</head>
	<body>
		<nav class="bg-gray-500">
			<div
				class="
					flex
					py-2
					flex-wrap
					justify-between
					w-full
					lg:max-w-7xl
					md:max-w-6xl
					mx-auto
				"
			>
				<div
					class="
						logo
						flex
						space-x-2
						items-center
						text-white
						px-3
						py-2
						text-2xl
						font-bold
						uppercase
					"
				>
					<div>
						<svg
							xmlns="http://www.w3.org/2000/svg"
							class="h-10 w-10"
							fill="none"
							viewBox="0 0 24 24"
							stroke="currentColor"
						>
							<path
								stroke-linecap="round"
								stroke-linejoin="round"
								stroke-width="2"
								d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"
							/>
						</svg>
					</div>
					<div class="mt-1">Insurance</div>
				</div>
				<div
					class="side-nav text-white font-semibold flex space-x-3 items-center"
				>
					<a href="index.php" class="text-lg py-3 px-2 hover:bg-gray-900 rounded"
						>Home</a
					>
					<a href="branch.php" class="text-lg py-3 px-2 hover:bg-gray-900 rounded"
						>Branch</a
					>
					<a href="clients.php" class="text-lg py-3 px-2 hover:bg-gray-900 rounded"
						>Clients</a
					>
					<a href="employee.php" class="text-lg py-3 px-2 hover:bg-gray-900 rounded"
						>Employee</a
					>
					<a href="scheme.php" class="text-lg py-3 px-2 hover:bg-gray-900 rounded"
						>Scheme</a
					>
					<a href="logout.php" class="text-lg py-3 px-2 hover:bg-gray-900 rounded"
						>Logout</a
					>
				</div>
			</div>
		</nav>

		<!-- main content -->
		<?php
			require('dbcon.php');

			$client_name = "";
			$email = "";
			$branch_id = "";
			$address = "";
			$update = false;
			$id = 0;

			if(isset($_GET['edit'])) {
				$id = $_GET['edit'];
				$sql = "SELECT * FROM client where id = '$id'";
				$res = mysqli_query($con, $sql);

				if(mysqli_num_rows($res) > 0) {
					$data = mysqli_fetch_array($res);
					$client_name = $data['client_name'];
					$email = $data['email'];
					$branch_id = $data['branch_id'];
					$address = $data['address'];
					$update = true;
				}
			}

			if(isset($_POST['add']))
			{
				$client_name = $_POST['client_name'];
				$email = $_POST['email'];
				$branch_id = $_POST['branch_id']; 
				$address = $_POST['address'];
				
				$sql = "insert into client (client_name,email, branch_id,address) values('$client_name', '$email', '$branch_id','$address')";

				$result = mysqli_query($con,$sql);

				if($result)
				{
					header("Location:clients.php");
				}
				else
				{
					echo "<div>
							<h3>Invalid Client.</h3>
						</div>";
				}
			}
			if(isset($_POST['edit']))
			{
				$client_name = $_POST['client_name'];
				$email = $_POST['email'];
				$branch_id = $_POST['branch_id']; 
				$address = $_POST['address'];

				$sql = "update client set client_name = '$client_name', email = '$email' , branch_id = '$branch_id', address = '$address' where id = '$id'";

				$result = mysqli_query($con,$sql);

				if($result)
				{
					header("Location:clients.php");
				}
				else
				{
					echo "<div>
							<h3>Invalid Client.</h3>
						</div>";
				}
			}
		?>

		<main class="w-6/12 mx-auto mt-4">
			<div class="">
                <div class="text-4xl text-gray-500 font-semibold border-b-2 border-gray-400 pb-2 mb-4">
                    Add Client
                </div>
                <div class="">
                    <form action="" method="post" class="flex flex-col space-y-2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<div class="flex flex-col max-w-full">
							<label for="">Client Name</label>
							<input
								type="text"
								name="client_name"
								value="<?php echo $client_name ?>"
								class="
									p-2
									rounded-lg
									border-2 border-gray-300
									focus:outline-none
								"
							/>
						</div>
						<div class="flex flex-col max-w-full">
							<label for="">Email</label>
							<input
								type="email"
								name="email"
								value="<?php echo $email ?>"
								class="
									p-2
									rounded-lg
									border-2 border-gray-300
									focus:outline-none
								"
							/>
						</div>
						<div class="flex flex-col max-w-full">
							<label for="">Branch</label>
                            <select name="branch_id" id="" class="p-2 rounded-lg bg-white border-2 border-gray-300">
								<?php 
									require("dbcon.php");
									$branch_sql = "select * from branch";
									$res = mysqli_query($con, $branch_sql);

									while($row = $res->fetch_assoc()):
								?>
                                <option value="<?php echo $row['id'] ?>" <?php if($row['id'] == $branch_id) echo 'selected' ?> ><?php echo $row['branch_name']?></option>
								<?php endwhile; ?>
                            </select>
						</div>
						<div class="flex flex-col max-w-full">
							<label for="">Address</label>
							<input
								type="text"
								name="address"
								value="<?php echo $address ?>"
								class="
									p-2
									rounded-lg
									border-2 border-gray-300
									focus:outline-none
								"
							/>
						</div>
						<div class="w-full">
							<?php if($update): ?>
							<button
								type="submit"
								name="edit"
								class="w-full mt-4 px-1 py-2 bg-green-500 rounded-lg text-white text-xl"
							>
								Update Client
							</button>
							<?php else: ?>
							<button
								type="submit"
								name="add"
								class="w-full mt-4 px-1 py-2 bg-green-500 rounded-lg text-white text-xl"
							>
								Add Client
							</button>
							<?php endif; ?>
						</div>
					</form>
                </div>
            </div>
		</main>
	</body>
</html>
