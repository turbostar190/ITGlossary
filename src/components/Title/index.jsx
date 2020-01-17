import React from 'react';
import PropTypes from 'prop-types';

export const Title = props => {
  return (<h4 id="name">{props.name}</h4>);
};

Title.propTypes = {
  name: PropTypes.string.isRequired,
};
