export interface Client {
  id: number;
  first_name: string;
  last_name: string;
  email: string | null;
  phone: string | null;
  cash_loan_amount: number | null;
  property_value: number | null;
  down_payment_amount: number | null;
  has_cash_loan: boolean;
  has_home_loan: boolean;
}
