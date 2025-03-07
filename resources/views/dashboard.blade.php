<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-4">
            <div class="p-4 border-b">
                <h2 class="text-lg font-bold text-white">Dashboard</h2>
            </div>
            
            <nav class="p-4">
                <ul class="space-y-2">
                    <li><a href="{{ route('dashboard') }}" class="block py-2 hover:bg-gray-700">Dashboard</a></li>
                   @can('manage_emploi')
                  <li><a href="{{ route('emplois.index') }}" class="block py-2 hover:bg-gray-700">Manage Jobs</a></li>
                    @endcan
                    @can('manage_formations')
                     <li><a href="{{ route('formations.index') }}" class="block py-2 hover:bg-gray-700">Manage Formations</a></li> 
                     @endcan
                     @can('manage_departments')
                    <li><a href="{{ route('departments.index') }}" class="block py-2 hover:bg-gray-700">Manage Departments</a></li>
                    @endcan
                    @can('manage_contrats')
                    <li><a href="{{ route('contrats.index') }}" class="block py-2 hover:bg-gray-700">Manage Contracts</a></li>
                    @endcan
                    @can('manage_grades')
                    <li><a href="{{ route('grades.index') }}" class="block py-2 hover:bg-gray-700">Manage Grade</a></li>
                    <li><a href="{{ route('conges.index') }}" class="block py-2 hover:bg-gray-700">Manage Conge</a></li>
                    @endcan
                    @can('manage_employe')
                    <li><a href="{{ route('employes.index') }}" class="block py-2 hover:bg-gray-700">Manage Employees</a></li>
                    <li><a href="{{ route('employes.organigramme') }}" class="block py-2 hover:bg-gray-700">Organigramme</a></li>
                    @endcan
                    <li><a href="{{ route('conges.create') }}" class="block py-2 hover:bg-gray-700">Demander conge</a></li>
                    
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">statistiques</h2>

            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-600">Total Emplois</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalEmplois ?? 0 }}</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-600">Total Utilisateurs</h3>
                    <p class="text-3xl font-bold text-green-500">{{ $totalUsers ?? 0 }}</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-600">Total Départements</h3>
                    <p class="text-3xl font-bold text-orange-500">{{ $totalDepartments ?? 0 }}</p>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-600">Total Contrats</h3>
                    <p class="text-3xl font-bold text-red-500">{{ $totalContrats ?? 0 }}</p>
                </div>

                <!-- Card 5-->

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-600">Total Formations</h3>
                    <p class="text-3xl font-bold text-yellow-500">{{$totalFormation}}</p>
                </div>

                 <!-- Card 6-->
                 <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-600">Total Grades</h3>
                    <p class="text-3xl font-bold text-brawn">{{$totalGrade}}</p>
                </div> 


            </div>
        </main>
    </div>

