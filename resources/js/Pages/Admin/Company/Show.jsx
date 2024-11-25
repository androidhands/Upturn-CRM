import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router } from "@inertiajs/react";


export default function Show({ auth, company, baseUrl }) {
  
   return (
      <AuthenticatedAdmin
         
         user={auth.user}
         header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{`Company ${company.name}`}</h2>}>
         <Head title={`Company ${company.name}`} />
         <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                  <div>
                     <img src={`${baseUrl}/storage/${company.logoUrl}`} alt="" className="w-64 h-64 object-fill" />
                  </div>
                  <div className="p-6 text-gray-900 dark:text-gray-100">

                     <div className="overflow-auto">


                        <div className="grid gap-1 grid-cols-2 mt-2">
                           {/* left side of grid */}
                           <div>
                              <div className="mt-4">
                                 <label


                                    className="font-bold text-lg"
                                 >Selected Countries</label>

                                 <div id="countries_select" className="mt-2">
                                    {company.countries.map((country) => (
                                       <div key={`country_${country.id}`} className="flex items-center mb-2">
                                          <img src={`${baseUrl}/storage/${country.flagUrl}`} alt="" style={{ width: 20, marginRight: 10 }} />
                                          <InputLabel key={country.id} className="text-lg text-gray-900 dark:text-gray-200">
                                             {country.name}
                                          </InputLabel>
                                       </div>
                                    ))}
                                 </div>

                              </div>
                              <div>
                                 <label className="font-bold text-lg">Company ID</label>
                                 <p className="mt-1">{company.id}</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Company Name</label>
                                 <p className="mt-1">{company.name}</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Company Industry</label>
                                 <p className="mt-1">{company.industry}</p>
                              </div>

                              <div className="mt-4">
                                 <label className="font-bold text-lg">CompanyType</label>
                                 <p className="mt-1">{company.type}</p>
                              </div>

                           </div>
                           {/* right side of grid */}
                           <div>

                              <div className="mt-4">
                                 <label className="font-bold text-lg">Create Date</label>
                                 <p className="mt-1">{company.created_at}</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Update Date</label>
                                 <p className="mt-1">{company.updated_at}</p>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>

      </AuthenticatedAdmin>
   );

}