import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PageHeader from "@/Components/PageHeader";
import TextInput from "@/Components/TextInput";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Create({ auth, company }) {
   const { data, setData, post, processing, errors, reset } = useForm({
      name: '',
   });
   
   const onSubmit = (e) => {
      e.preventDefault();

      post(route("office.store",company.id));
   }
   const breadcrumbs = [
      { name: company.name, href: route('company.show', company.id) },
      { name: 'Offices', href: route('office.index', company.id) },
      { name: 'Create New Office', href: route('office.create', company.id) },
      

   ];
   return (
      <AuthenticatedAdmin
         user={auth.user}
         header={
            <PageHeader breadcrumbs={breadcrumbs}/>
         }>
         <Head title="Create New Office" />

         <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                  <form className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                     
                     onSubmit={onSubmit}>
                     <div className="mt-4">
                        <InputLabel
                           htmlFor="office_name"
                           value="Office Name"
                        />
                        <TextInput
                           id="office_name"
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
                        <Link href={route('office.index',company.id)} className="inoffice-block bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all horver:bg-gray-200 mr-2">Cancel</Link>
                        <button className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600" >Submit</button>

                     </div>
                  </form>
               </div>
            </div>

         </div>
      </AuthenticatedAdmin>
   );
}