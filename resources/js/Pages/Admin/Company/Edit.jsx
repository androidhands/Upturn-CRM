import Checkbox from "@/Components/Checkbox";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import SelectInput from "@/Components/SelectInput";
import TextInput from "@/Components/TextInput";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";


export default function Edit({ auth, company, baseUrl, countries }) {
   
   const { data, setData, post, processing, errors, reset } = useForm({

      logoUrl:"",
      name: company.name || "",
      industry: company.industry || "",
      type: company.type || "",
      countries:company.countries.map((c)=>(String(c.id))) || [],
      _method:'PUT'
   });
   const onSubmit = (e) => {
      e.preventDefault();
       
      post(route('company.update', company.id));
   }
   return (
      <AuthenticatedLayout
         user={auth.user}
         header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Company "{company.name}"</h2>}>
         <Head title="Edit Company" />

         <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                  <form className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                     onSubmit={onSubmit}>
                     

                     {company.logoUrl && <div className="mb-4">
                        <img src={`${baseUrl}/storage/${company.logoUrl}`} className="w-35 h-35" alt="" /></div>}

                     <div>
                        <InputLabel
                           htmlFor="company_logoUrl_path"
                           value="Company Logo"
                        />
                        <TextInput
                           id="company_logoUrl_path"
                           type="file"
                           name="logoUrl"
                           className="mt-1 block w-full"
                           onChange={e => setData('logoUrl', e.target.files[0] )}
                        />
                        <InputError message={errors.logoUrl} className="mt-2 " />
                     </div>
                     <div className="mt-4">

                     </div>

                     <div>
                     <InputLabel
                           htmlFor="countries_select"
                           value="Select Countries"
                        />
                       
                        <div id="countries_select" className="mt-2">
                           {countries.data.map((country) => (
                              <div key={`country_${country.id}`} className="flex items-center mb-2">
                                 <Checkbox
                                 
                                    id={`country_${country.id}`}
                                    name="countries"
                                    value={country.id}
                                    checked={data.countries.includes(String(country.id))}
                                    onChange={(e) => {
                                      
                                          const countryId = String(e.target.value);
                                          const updatedCountries = e.target.checked
                                             ? [...data.countries, countryId]
                                             : data.countries.filter(id => id !== countryId);
                                             if (updatedCountries.length === 0) {
                                                alert("At least one country must be selected.");
                                                return;
                                             }
                                          setData('countries', updatedCountries);
                                       
                                       
                                     
                                    }}
                                    className="mr-2"
                                 />

                                 <InputLabel htmlFor={`country_${country.id}`} key={country.id} className="text-sm text-gray-800 dark:text-gray-200">
                                    {country.name}
                                 </InputLabel>
                              </div>
                           ))}
                        </div>
                        <InputError message={errors.countries} className="mt-2" />
                     </div>

                     <div className="mt-4">
                        <InputLabel
                           htmlFor="company_name"
                           value="Company Name"
                        />
                        <TextInput
                           id="company_name"
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
                           htmlFor="company_industry"
                           value="Company Industry"
                        />
                        <SelectInput
                           id="company_industry"
                           name="industry"
                           className="mt-1 block w-full"
                           onChange={e => setData('industry', e.target.value)}
                        >
                           <option value="">Select Industry</option>
                           <option value="pharmaceuticals">Pharmaceutical</option>
                        </SelectInput>
                        <InputError message={errors.code} className="mt-2 " />
                     </div>
                     <div className="mt-4">
                        <InputLabel
                           htmlFor="company_type"
                           value="Company Type"
                        />
                        <SelectInput
                           id="company_type"
                           name="type"
                           className="mt-1 block w-full"
                           onChange={e => setData('type', e.target.value)}
                        >
                           <option value="">Select Type</option>
                           <option value="startup">Startup</option>
                           <option value="stablished">Stablished</option>
                        </SelectInput>
                        <InputError message={errors.code} className="mt-2 " />
                     </div>
                   
                     <div className="mt-4 text-right">
                        <Link href={route('company.index')} className="inline-block bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all horver:bg-gray-200 mr-2">Cancel</Link>
                        
                        <button className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600" >Submit</button>

                     </div>
                  </form>
               </div>
            </div>

         </div>
      
      </AuthenticatedLayout>
   );
}