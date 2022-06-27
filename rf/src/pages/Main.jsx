import React from 'react';
import {Routes, Route} from 'react-router-dom';
import Login from './Login';
import CreateAccount from './CreateAccount';
import FourOhFour from './FourOhFour';
import Accounts from './Accounts';
import AdminLogin from './AdminLogin';
import CreateAdmin from './CreateAdmin';
import AddFunds from './AddFunds';
import WithdrawFunds from './WithdrawFunds';

function Main() 
{
  //add a redirect from default path when user is logged in

  return (
    <Routes>
      {/* <Route exact path='/' component={Home} /> */}
      <Route exact path='/login' element={<Login />} />
      <Route exact path='/accounts' element={<Accounts />} />
      <Route exact path='/account-creation-form' element={<CreateAccount />} />
      <Route exact path='/add-funds' element={<AddFunds />} />
      <Route exact path='/withdraw-funds' element={<WithdrawFunds />} />
      <Route exact path='/admin-login' element={<AdminLogin />} />
      <Route exact path='/create-admin' element={<CreateAdmin />} />
      <Route exact path='*' element={<FourOhFour />} />
      <Route exact path='/' element={<Login />} />
    </Routes>
  );
}

export default Main;