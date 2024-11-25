import SelectInput from "@/Components/SelectInput";
import TableHeading from "@/Components/TableHeading";
import TextInput from "@/Components/TextInput";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, router } from "@inertiajs/react";
import Pagination from "@/Components/Pagination";


export default function Index({ auth, users, queryParams = null, success }) {
   queryParams = queryParams || {}
   const searchFiledChanged = (name, value) => {
      if (value) {
         queryParams[name] = value;
      } else {
         delete queryParams[name];
      }
      router.get(route('user.index', queryParams));
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
      router.get(route('user.index', queryParams));
   }

   const deleteUser = (user) => {
      if (!window.confirm('Are you sure to delete the user?')) {
         return;
      }
      router.delete(route('user.destroy', user.id));
   }
   return (
      <AuthenticatedLayout
         user={auth.user}
         header={
            <div className="flex justify-between items-center">
               <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Users</h2>
               <Link className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600"
                  href={route('user.create')}>Add New</Link>
            </div>
         }>


         <Head title="Users" />




         <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               {success && (<div className="bg-emerald-500 py-4 px-2 text-white rounded shadow transition-all hover:bg-emerald-600 mb-4" >
                  {success}</div>)}
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
                                    <TextInput className="w-full" defaultValue={queryParams.name} placeholder="User Name" onKeyPress={(e) => onKeyPress("name", e)} />
                                 </td>
                                 <td className="px-3 py-3">
                                    <TextInput className="w-full" defaultValue={queryParams.email} placeholder="Email" onKeyPress={(e) => onKeyPress("email", e)} />
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
                                 <TableHeading
                                    field={'email'}
                                    sort_field={queryParams.sort_field}
                                    sort_direction={queryParams.sort_direction}
                                    sortChanged={sortChanged}
                                 >Email</TableHeading>
                                 <th className="px-3 py-3">Created At</th>
                                 <th className="px-3 py-3 text-right">Actions</th>
                              </tr>
                           </thead>

                           <tbody>
                              {users.data.map(user => (
                                 <tr key={user.id}
                                    className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th className="px-3 py-2">
                                       {user.id}
                                    </th>
                                    <th className="px-3 py-2 text-white text-nowrap">
                                    {user.name}
                                    </th>
                                    <td className="px-3 py-2">
                                       {user.email}
                                    </td>
                                    <td className="px-3 py-2">
                                       {user.created_at}
                                    </td>
                                   
                                    <td className="px-3 py-2 text-nowrap">
                                       <Link href={route("user.edit", user.id)} className="text-blue-600 dark:text-blue-500 hover:underline mx-1">
                                          Edit
                                       </Link>
                                       <button onClick={e => deleteUser(user)} className="text-red-600 dark:text-red-500 hover:underline mx-1">
                                          Delete
                                       </button>
                                    </td>
                                 </tr>
                              ))}
                           </tbody>
                        </table>
                     </div>
                     <Pagination links={users.meta.links} />
                  </div>
               </div>
            </div>
         </div>
      </AuthenticatedLayout>
   );
}