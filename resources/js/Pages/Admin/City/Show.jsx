import { Head, Link, router } from "@inertiajs/react";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import PageHeader from "@/Components/PageHeader";
import SvgDistrict from "@/Components/SvgIcons/District";
import NavLink from "@/Components/NavLink";

export default function Show({ auth, city, governorate, country }) {

   const breadcrumbs = [
      { name: governorate.name, href: route('governorate.show', [country.id, governorate.id]) },
      { name: 'Cities', href: route('city.index',[country.id, governorate.id]) },
      { name: city.name, href: route('city.show', [country.id,governorate.id, city.id]) },


   ];
   return (
      <AuthenticatedAdmin
         user={auth.user}
         header={
            <PageHeader breadcrumbs={breadcrumbs}/>
         }>
         <Head title={`City ${city.name}`} />
         <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                  <div className="p-6 text-gray-900 dark:text-gray-100">
                     <div className="overflow-auto">
                        <div className="grid gap-1 grid-cols-2 mt-2">
                           {/* left side of grid */}
                           <div>
                              <div>
                                 <label className="font-bold text-lg">City ID</label>
                                 <p className="mt-1">{city.id}</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">City Name</label>
                                 <p className="mt-1">{city.name}</p>
                              </div>

                           </div>
                           {/* right side of grid */}
                           <div>


                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               <div className="mt-4 text-right">
                  <Link href={route('city.index', [country.id,governorate.id])} className="incity-block bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all horver:bg-gray-200 mr-2">Cancel</Link>
               </div>
            </div>


         </div>

       

      </AuthenticatedAdmin>
   );

}