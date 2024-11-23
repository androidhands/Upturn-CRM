import { Link } from "@inertiajs/react";

export default function Pagination({links}) {
   return (
      <nav className="text-center mt-4">
         {links.map(link => (
            <Link
               // preserve scroll -> prevent page move up when user click the link
               preserveScroll
               href={link.url || ""}
               key={link.label}
               className={
                  "inline-block py-5 px-5 rounded-lg text-gray-200 text-xs " + (
                     link.active?"bg-gray-950 ":" " + (!link.url? "!text-gray-500 cursor-not-allowed ": "hover:bg-gray-950")
                  )
               }
               dangerouslySetInnerHTML={{ __html: link.label }}>
              
            </Link>
         ))}

      </nav>
   );
}