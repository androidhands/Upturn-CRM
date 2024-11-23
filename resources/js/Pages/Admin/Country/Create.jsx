import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Create({ auth }) {
   const { data, setData, post, processing, errors, reset } = useForm({
      flagUrl: '',
      name: '',
      code: '',
      phoneCode: '',
      
   });
   const onSubmit = (e) => {
      e.preventDefault();

      post(route("country.store"));
   }
   return (
      <AuthenticatedAdmin
         user={auth.user}
         header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create New Country</h2>}
      >
         <Head title="Create New Country" />
         <div className="p-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg-px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" >
                  <form className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                    onSubmit={onSubmit} >

                  <div >
                        <InputLabel
                           htmlFor="name"
                           value="Country Name"
                        />
                        <TextInput
                           id="name"
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
                           htmlFor="code"
                           value="Country Code"
                        />
                        <TextInput
                           id="code"
                           name="name"
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
                           name="phoneCode"
                           value={data.phoneCode}
                           className="mt-1 block w-full"
                           onChange={e => setData('phoneCode', e.target.value)}
                        />
                        <InputError message={errors.phoneCode} className="mt-2 " />
                     </div>
                     <div className="mt-4">
                        <InputLabel
                           htmlFor="flag_path"
                           value="Country Flag"
                        />
                        <TextInput
                           id="flag_path"
                           type="file"
                           name="image"
                           className="mt-1 block w-full"
                           onChange={e => setData('flagUrl', e.target.files[0])}
                        />
                        <InputError message={errors.flagUrl} className="mt-2 " />
                     </div>

                     <div className="mt-4 text-right">
                        <Link href={route('country.index')} className="inline-block bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all horver:bg-gray-200 mr-2">Cancel</Link>
                        <button className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600" >Submit</button>

                     </div>

                  </form>

               </div>

            </div>
         </div>

      </AuthenticatedAdmin>
   );
}