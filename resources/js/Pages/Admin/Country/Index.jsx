import AuthenticatedAdminLayout from '@/Layouts/AuthenticatedAdminLayout';
import { Head, Link, router } from "@inertiajs/react";
import Pagination from "@/Components/Pagination";
import TableHeading from "@/Components/TableHeading";
import TextInput from "@/Components/TextInput";
import SuccessMessage from '@/Components/SuccessMessage';
export default function Index({ auth, countries, queryParams = null, success, baseUrl }) {
    queryParams = queryParams||{}
    const searchFiledChanged = (name, value) => {
       if (value) {
          queryParams[name] = value;
       } else {
          delete queryParams[name];
       }
       router.get(route('country.index', queryParams));
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
       router.get(route('country.index', queryParams));
    }
 
    const deletecountry = (country) => {
       if (!window.confirm('Are you sure to delete the country?')) {
          return;
       }
       router.delete(route('country.destroy', country.id));
    }
   return (
      <AuthenticatedAdminLayout
      user={auth.user}
         header={
            <div className='flex justify-between items-center'>
               <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Countries</h2>
               <Link className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600"
               href={route('country.create')}>Add New</Link>
         </div>
      }
  >
      <Head title="Countires" />

      <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <SuccessMessage>{ success}</SuccessMessage>
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
                                       onKeyPress={(e)=>onKeyPress("id",e)}
                                    />
                              </td>
                              <td className="px-3 py-3">
                                 <TextInput className="w-full" defaultValue={queryParams.name} placeholder="Country Name"  onKeyPress={(e) => onKeyPress("name", e)} />
                              </td>
                             
                              <td className="px-3 py-3"></td>
                              <td className="px-3 py-3"></td>
                              <td className="px-3 py-3"></td>
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
                                    field={'code'}                                
                                    sort_field={queryParams.sort_field}
                                    sort_direction={queryParams.sort_direction}
                                    sortChanged={sortChanged}
                                 >Code</TableHeading>
                                 <TableHeading
                                    field={'phoneCode'}                                
                                    sort_field={queryParams.sort_field}
                                    sort_direction={queryParams.sort_direction}
                                    sortChanged={sortChanged}
                                 >Phone Code</TableHeading>
                                <TableHeading
                                    field={'flagUrl'}                                
                                    sort_field={queryParams.sort_field}
                                    sort_direction={queryParams.sort_direction}
                                    sortChanged={sortChanged}
                                 >Flag</TableHeading>      
                                 
                                           <th className="px-3 py-3">Created At</th>        
                                           <th className="px-3 py-3">Updated At</th>                  
                                
                           </tr>
                        </thead>

                        <tbody>
                           {countries.data.map(country => (
                              
                              <tr key={country.id}
                                 className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                         
                                 <th className="px-3 py-2">
                               {country.id}  
                                 
                                 </th>

                                 
                                


                                 <th className="px-3 py-2 hover-underline text-white text-nowrap">
                                    <Link href={route("country.show", country.id)}>
                                    {country.name}  
                                    </Link>
                                    
                                 </th>
                                 <td className="px-3 py-2">
                               {country.code}  
                                   </td>
                                   <td className="px-3 py-2">
                               {country.phoneCode}  
                                 </td>
                               
                                   <td className="px-3 py-2">
                                    <img src={`${baseUrl}/storage/${country.flagUrl}`}   alt="" style={{width:20}} />
                               
                                   </td>
                                   <td className="px-3 py-2 text-npwrap">
                               {country.created_at}  
                                   </td>
                                 <td className="px-3 py-2">
                               {country.updated_at}  
                                 </td>
                              
                                 <td className="px-3 py-2 text-nowrap">
                                    <Link href={route("country.edit", country.id)} className="text-blue-600 dark:text-blue-500 hover:underline mx-1">
                                       Edit
                                    </Link>
                                    <button onClick={e =>deletecountry(country)} className="text-red-600 dark:text-red-500 hover:underline mx-1">
                                       Delete
                                    </button>
                                 </td>
                               
                                 
                                 
                           </tr>
                           ))}
                         
                        </tbody>
                     </table>
                     </div>
                     <Pagination links={countries.meta.links} />

                  </div>
                    </div>
                </div>
            </div>
  </AuthenticatedAdminLayout>
   );
}