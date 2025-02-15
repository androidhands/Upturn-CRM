import SelectInput from "@/Components/SelectInput";
import TableHeading from "@/Components/TableHeading";
import TextInput from "@/Components/TextInput";
import { Head, Link, router } from "@inertiajs/react";
import Pagination from "@/Components/Pagination";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import SuccessMessage from "@/Components/SuccessMessage";
import NavLink from "@/Components/NavLink";
import PageHeader from "@/Components/PageHeader";


export default function Index({ auth, departments, queryParams = null, success, company }) {
   queryParams = queryParams || {}
   const searchFiledChanged = (name, value) => {
      if (value) {
         queryParams[name] = value;
      } else {
         delete queryParams[name];
      }
      router.get(route(`department.index`, [company.id, queryParams]));
   }

   const onKeyPress = (name, e) => {
      if (e.key !== 'Enter') return;
      searchFiledChanged(name, e.target.value);
   }

   const sortChanged = (name) => {
      if (name === queryParams.sort_field) {
         if (queryParams.sort_direction === 'asc') {
            queryParams.sort_direction = 'desc';
         } else {
            queryParams.sort_direction = 'asc';
         }
      } else {
         queryParams.sort_field = name;
         queryParams.sort_direction = 'asc';
      }
      router.get(route(`department.index`, [company.id, queryParams]));
   }

   const deleteDepartment = (department) => {
      if (!window.confirm('Are you sure to delete the department?')) {
         return;
      }
      router.delete(route(`department.destroy`, [company.id, department.id]));
   }
   const breadcrumbs = [
      { name: company.name, href: route('company.show', company.id) },
      { name: 'Business Units', href: route('department.index', company.id) },

   ];
   return (
      <AuthenticatedAdmin
         user={auth.user}
         header={
            <div className="flex justify-between items-center">

              <PageHeader breadcrumbs={breadcrumbs} />
               <Link className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600"
                  href={route(`department.create`, company.id)}>Add New</Link>
            </div>
         }>


         <Head title="Business Units" />




         <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <SuccessMessage>{success}</SuccessMessage>
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                  <div className="p-6 text-gray-900 dark:text-gray-100">

                     <div className="overflow-auto">
                        <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                           <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-gray-500">
                              <tr className="text-nowrap">
                                 <td className="px-3 py-3">
                                    <TextInput
                                       className="w-full"
                                       defaultValue={queryParams.id}
                                       placeholder="Id"
                                       onKeyPress={(e) => onKeyPress("id", e)}
                                    />
                                 </td>
                                 <td className="px-3 py-3">
                                    <TextInput className="w-full" defaultValue={queryParams.name} placeholder="Role Name" onKeyPress={(e) => onKeyPress("name", e)} />
                                 </td>

                                 <td className="px-3 py-3"></td>
                                 <td className="px-3 py-3"></td>
                              </tr>
                           </thead>
                           <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-gray-500">
                              <tr className="text-nowrap">
                                 <TableHeading
                                    field={'id'}
                                    sort_field={queryParams.sort_field}
                                    sort_direction={queryParams.sort_direction}
                                    sortChanged={sortChanged}
                                 >ID</TableHeading>

                                 <TableHeading
                                    field={'name'}
                                    sort_field={queryParams.sort_field}
                                    sort_direction={queryParams.sort_direction}
                                    sortChanged={sortChanged}
                                 >Name</TableHeading>

                                 <th className="px-3 py-3">Created At</th>
                                 <th className="px-3 py-3 text-right">Actions</th>
                              </tr>
                           </thead>

                           <tbody>
                              {departments.data.map(department => (
                                 <tr key={department.id}
                                    className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th className="px-3 py-2">
                                       {department.id}
                                    </th>
                                    <th className="px-3 py-2 text-white text-nowrap">
                                       <Link href={route(`department.show`, [company.id, department.id])}>
                                          {department.name}
                                       </Link>
                                    </th>

                                    <td className="px-3 py-2">
                                       {department.created_at}
                                    </td>

                                    <td className="px-3 py-2 text-nowrap">
                                       <Link href={route(`department.edit`, [company.id, department.id])} className="text-blue-600 dark:text-blue-500 hover:underline mx-1">
                                          Edit
                                       </Link>
                                       <button onClick={e => deleteDepartment(department)} className="text-red-600 dark:text-red-500 hover:underline mx-1">
                                          Delete
                                       </button>
                                    </td>
                                 </tr>
                              ))}
                           </tbody>
                        </table>
                     </div>
                     <Pagination links={departments.meta.links} />
                  </div>
               </div>
            </div>
         </div>
      </AuthenticatedAdmin>
   );
}
