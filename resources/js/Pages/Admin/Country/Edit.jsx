import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";


export default function Edit({ auth, selectedCountry, baseUrl }) {
   
   const { data, setData, post, processing, errors, reset } = useForm({

      flagUrl:"",
      name: selectedCountry.name || "",
      code: selectedCountry.code || "",
      phoneCode: selectedCountry.phoneCode || "",
      _method:'PUT'
   });
   const onSubmit = (e) => {
      e.preventDefault();
       
      post(route('country.update', selectedCountry.id));
   }
   return (
      <AuthenticatedLayout
         user={auth.user}
         header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Country "{selectedCountry.name}"</h2>}>
         <Head title="Create New Country" />

         <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                  <form className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                     onSubmit={onSubmit}>
                     

                     {selectedCountry.flagUrl && <div className="mb-4">
                        <img src={`${baseUrl}/storage/${selectedCountry.flagUrl}`} className="w-64" alt="" /></div>}

                     <div>
                        <InputLabel
                           htmlFor="country_flagUrl_path"
                           value="Country Image"
                        />
                        <TextInput
                           id="country_flagUrl_path"
                           type="file"
                           name="flagUrl"
                           className="mt-1 block w-full"
                           onChange={e => setData('flagUrl', e.target.files[0] )}
                        />
                        <InputError message={errors.flagUrl} className="mt-2 " />
                     </div>
                     <div className="mt-4">
                        <InputLabel
                           htmlFor="country_name"
                           value="Country Name"
                        />
                        <TextInput
                           id="country_name"
                           type="text"
                           name="name"
                           value={data.name}
                           isFocused="true"
                           className="mt-1 block w-full"
                           onChange={e => setData('name', e.target.value)}
                        />
                        <InputError message={errors.name} className="mt-2 " />
                     </div>
                     <div className="mt-4">
                        <InputLabel
                           htmlFor="country_code"
                           value="Country Code"
                        />
                        <TextInput
                           id="country_code"
                           name="code"
                           value={data.code}
                           className="mt-1 block w-full"
                           onChange={e => setData('code', e.target.value)}
                        />
                        <InputError message={errors.code} className="mt-2 " />
                     </div>
                     <div className="mt-4">
                        <InputLabel
                           htmlFor="phone_code"
                           value="Phone Code"
                        />
                        <TextInput
                           id="phone_code"
                           type="text"
                           name="phoneCode"
                           value={data.phoneCode}
                           className="mt-1 block w-full"
                           onChange={e => setData('phoneCode', e.target.value)}
                        />
                        <InputError message={errors.phoneCode} className="mt-2 " />
                     </div>
                   
                     <div className="mt-4 text-right">
                        <Link href={route('country.index')} className="inline-block bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all horver:bg-gray-200 mr-2">Cancel</Link>
                        
                        <button className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600" >Submit</button>

                     </div>
                  </form>
               </div>
            </div>

         </div>
      
      </AuthenticatedLayout>
   );
}