import InputLabel from "@/Components/InputLabel";
import NavLink from "@/Components/NavLink";
import SvgBusinessUnit from "@/Components/SvgIcons/BusinessUnit";
import SvgDistrict from "@/Components/SvgIcons/District";
import SvgLines from "@/Components/SvgIcons/Lines";
import SvgOffice from "@/Components/SvgIcons/Office";
import SvgProduct from "@/Components/SvgIcons/Product";
import SvgRegion from "@/Components/SvgIcons/Region";
import SvgRole from "@/Components/SvgIcons/Role";
import SvgStructure from "@/Components/SvgIcons/Structure";
import SvgTerritory from "@/Components/SvgIcons/Territory";
import SvgUser from "@/Components/SvgIcons/User";
import SvgWidget from "@/Components/SvgWidget";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import { Head, Link, router } from "@inertiajs/react";


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
                     <img src={`${baseUrl}/storage/${company.logoUrl}`} alt="" className="w-full h-64 object-fill" />
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
         <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
            <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div className="mb-4 mt-4 items-center">
                  <NavLink href={route(`user.index`, company.id)}
                  >
                     <div className="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-green-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" >
                        <div className="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full">
                           <SvgUser className="w-7 h-7 stroke-green-500" />
                        </div>
                        <h4 className="mt-6 ml-2 text-s font-semibold text-gray-900 dark:text-white">
                           Users
                        </h4>

                     </div>
                  </NavLink>
                  <NavLink href={route(`region.index`, company.id)}
                  >
                     <div className="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-green-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" >
                        <div className="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full">
                           <SvgRegion className="w-7 h-7 stroke-green-500" color="green" />
                        </div>
                        <h4 className="mt-6 ml-2 text-s font-semibold text-gray-900 dark:text-white">
                           Regions
                        </h4>

                     </div>
                  </NavLink>

                  <NavLink href={route(`businessUnit.index`, company.id)}
                  >
                     <div className="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-green-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" >
                        <div className="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full">
                           <SvgBusinessUnit className="w-7 h-7 stroke-green-500" color="green" />
                        </div>
                        <h4 className="mt-6 ml-2 text-s font-semibold text-gray-900 dark:text-white">
                           Business Units
                        </h4>

                     </div>
                  </NavLink>
                  <NavLink href={route(`line.index`, company.id)}
                  >
                     <div className="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-green-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" >
                        <div className="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full">
                           <SvgLines className="w-7 h-7 stroke-green-500" color="green" />
                        </div>
                        <h4 className="mt-6 ml-2 text-s font-semibold text-gray-900 dark:text-white">
                           Lines
                        </h4>

                     </div>
                  </NavLink>
                  <NavLink href={route(`district.index`, company.id)}
                  >
                     <div className="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-green-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" >
                        <div className="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full">
                           <SvgDistrict className="w-7 h-7 stroke-green-500" color="green" />
                        </div>
                        <h4 className="mt-6 ml-2 text-s font-semibold text-gray-900 dark:text-white">
                           Districts
                        </h4>

                     </div>
                  </NavLink>
                  <NavLink href={route(`territory.index`, company.id)}
                  >
                     <div className="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-green-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" >
                        <div className="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full">
                           <SvgTerritory className="w-7 h-7 stroke-green-500" color="green" />
                        </div>
                        <h4 className="mt-6 ml-2 text-s font-semibold text-gray-900 dark:text-white">
                           Territories
                        </h4>

                     </div>
                  </NavLink>
                  <NavLink href={route(`product.index`, company.id)}
                  >
                     <div className="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-green-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" >
                        <div className="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full">
                           <SvgProduct className="w-7 h-7 stroke-green-500" color="green" />
                        </div>
                        <h4 className="mt-6 ml-2 text-s font-semibold text-gray-900 dark:text-white">
                           Products
                        </h4>

                     </div>
                  </NavLink>
                  <NavLink href={route(`user.index`, company.id)}
                  >
                     <div className="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-green-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" >
                     <div className="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full">
                           <SvgStructure className="w-7 h-7 stroke-green-500" color="green" />
                        </div>
                        <h4 className="mt-6 ml-2 text-s font-semibold text-gray-900 dark:text-white">
                           Structure
                        </h4>

                     </div>
                  </NavLink>
                  <NavLink href={route(`user.index`, company.id)}
                  >
                     <div className="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-green-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" >
                     <div className="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full">
                           <SvgOffice className="w-7 h-7 stroke-green-500" color="green" />
                        </div>
                        <h4 className="mt-6 ml-2 text-s font-semibold text-gray-900 dark:text-white">
                           Offices
                        </h4>

                     </div>
                  </NavLink>
                  <NavLink href={route(`role.index`, company.id)}
                  >
                     <div className="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-green-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" >
                     <div className="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full">
                           <SvgRole className="w-7 h-7 stroke-green-500" color="green" />
                        </div>
                        <h4 className="mt-6 ml-2 text-s font-semibold text-gray-900 dark:text-white">
                           Roles
                        </h4>

                     </div>
                  </NavLink>

               </div>
              
            </div>
            <div className="mt-4 text-right">
                           <Link href={route('company.index')} className="inline-block bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all horver:bg-gray-200 mr-2">Cancel</Link>
                        </div>
         </div>

      </AuthenticatedAdmin>
   );

}