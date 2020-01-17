import React from 'react';
import PropTypes from 'prop-types';

export const PageTitle = props => {
  return <h2 className="left-align blue-text text-darken-2">{props.name}</h2>
};

PageTitle.propTypes = {
  name: PropTypes.string.isRequired,
};
