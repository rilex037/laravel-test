export interface Client {
    id: number;
    first_name: string;
    last_name: string;
    email: string | null;
    phone: string | null;
    has_cash_loan: boolean;
    has_home_loan: boolean;
  }