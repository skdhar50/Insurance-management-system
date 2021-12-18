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
		<title>Employee</title>

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

			if(isset($_GET['delete'])) {
				$id = $_GET['delete'];
				$sql = "DELETE FROM employee where id = '$id'";
				$res = mysqli_query($con, $sql);

				if($res) {
					header("Location:employee.php");
				} else {
					echo "Error";
				}
			}
		?>

		<main class="max-w-7xl mx-auto mt-4">
			<header>
				<p
					class="
						text-4xl
						border-b-2 border-gray-400
						font-semibold
						text-gray-500
						p-4
					"
				>
					Employee List
				</p>
			</header>
			<article class="mt-4 flex flex-col space-y-3">
				<div class="flex justify-end">
					<a
						href="add_employee.php"
						class="
							py-2
							px-3
							bg-green-600
							font-semibold
							text-white
							rounded-lg
							hover:bg-green-700
						"
					>
						Create New Employee
					</a>
				</div>
				<div>
					<table class="shadow-xl table-fixed w-full">
						<thead class="bg-gray-700 text-white">
							<tr>
								<th>Employee Name</th>
								<th>Email</th>
								<th>Branch</th>
								<th>Contact</th>
								<th>Address</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								require("dbcon.php");

								$query = "select * from employee";
								$res = mysqli_query($con, $query);

								while($row = $res->fetch_assoc()):
							?>
							<tr class="text-center">
								<td><?php echo $row['employee_name']?></td>
								<td><?php echo $row['email']?></td>
								<td>
								<?php
									$branch = "select * from branch where id = ".$row['branch_id']."";
									$data = mysqli_query($con, $branch);
									$result = mysqli_fetch_assoc($data);
								 	echo $result['branch_name'];
								 ?>
								 </td>
								<td><?php echo $row['contact']?></td>
								<td><?php echo $row['address']?></td>
								<td>
									<a
										href="add_employee.php?edit=<?php echo $row['id']; ?>"
										class="
											py-1
											px-2
											bg-green-700
											text-white
											rounded-lg
											hover:bg-green-900
										"
									>
										Update
									</a>
									<a
										href="employee.php?delete=<?php echo $row['id']; ?>"
										class="
											py-1
											px-2
											bg-red-600
											text-white
											rounded-lg
											hover:bg-red-800
										"
									>
										Delete
									</a>
								</td>
							</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</article>
		</main>
	</body>
</html>