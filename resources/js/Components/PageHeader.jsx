import React from 'react';
import NavLink from './NavLink';


const PageHeader = ({ breadcrumbs }) => {
  return (
    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {breadcrumbs.map((breadcrumb, index) => (
        <span key={index}>
          <NavLink
            href={breadcrumb.href}
            className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
          >
            {breadcrumb.name}
          </NavLink>
          {index < breadcrumbs.length - 1 && ' / '}
        </span>
      ))}
    </h2>
  );
};

export default PageHeader;
