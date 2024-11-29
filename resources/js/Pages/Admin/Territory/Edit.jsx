import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PageHeader from "@/Components/PageHeader";
import SelectInput from "@/Components/SelectInput";

import TextInput from "@/Components/TextInput";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Edit({ auth, territory, company }) {
   const { data, setData, put, processing, errors, reset } = useForm({
      name: territory.name || "",

   });
   const onSubmit = (e) => {
      e.preventDefault();

      put(route('territory.update',[company.id, territory.id]));
   }
   const breadcrumbs = [
      { name: company.name, href: route('company.show', company.id) },
      { name: 'Territorys', href: route('territory.index', company.id) },
      { name: `Edit ${territory.name}`, href: route('territory.edit', [company.id, territory.id]) },

   ];
   return (
      <AuthenticatedAdmin
         user={auth.user}
         header={
            <PageHeader breadcrumbs={breadcrumbs}/>
         }>
         <Head title="Edit Territory" />

         <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                  <form className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                     onSubmit={onSubmit}>

                     <div className="mt-4">
                        <InputLabel
                           htmlFor="territory_name"
                           value="Territory Name"
                        />
                        <TextInput
                           id="territory_name"
                           type="text"
                           name="name"
                           value={data.name}
                           isFocused="true"
                           className="mt-1 block w-full"
                           onChange={e => setData('name', e.target.value)}
                        />
                        <InputError message={errors.name} className="mt-2 " />
                     </div>

                     <div className="mt-4 text-right">
                        <Link href={route('territory.index',company.id)} className="inline-block bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all horver:bg-gray-200 mr-2">Cancel</Link>

                        <button className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600" >Submit</button>

                     </div>
                  </form>
               </div>
            </div>

         </div>
      </AuthenticatedAdmin>
   );
}